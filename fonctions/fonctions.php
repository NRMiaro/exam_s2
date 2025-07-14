    <?php 

    require("connectDB.php");

    function connexionValide($nom, $mdp){
        $db = getDB();
        $sql = "SELECT * FROM emprunts_membre WHERE nom = '$nom' AND mdp = '$mdp'";
        echo $sql;
        $data = mysqli_query($db, $sql);
        if ($line = mysqli_fetch_assoc(($data)))
            return true;
        else return false;
    }
    function isUnusedPseudo($pseudo){
        if ($db = getDB()){
            $sql = "SELECT * FROM emprunts_membre WHERE nom = '$pseudo' ";
            $login = mysqli_query($db, $sql);
            if ($line = mysqli_fetch_assoc($login))
                return false;
            else return true;
        }
    }
    function addUser($pseudo, $mdp,$email,$ville,$genre,$image,$naissance){
        if (isUnusedPseudo($pseudo)){
            $db = getDB();
            $sql = "INSERT INTO  emprunts_membre(nom,mdp,date_naissance,genre,email,ville,image_profil) VALUES ('$pseudo', '$mdp','$naissance','$genre','$email','$ville','image')";
            mysqli_query($db, $sql);
        }
    }

    function getObjets(){
        $db = getDB();
        $sql = "SELECT * FROM vue_objets_date_retour";
        $data = mysqli_query($db, $sql);
        $liste = [];
        while ($line = mysqli_fetch_assoc($data)){
            $retour = $line['date_retour'] == null ? "Non emprunté" : $line['date_retour'];
            $liste[] = [
                'nom' => $line['objet'],
                'retour' => $retour
            ];
        }
        return $liste;
    }

    function getCategories(){
        $db = getDB();
        $sql = "SELECT nom_categorie FROM emprunts_categorie_objet";
        $result = mysqli_query($db, $sql);
        $liste = [];
        while ($line = mysqli_fetch_assoc($result)){
            $liste[] = $line['nom_categorie'];
        }
        return $liste;
    }

    function getObjetsParCategorie($categorie){
        $db = getDB();

        if ($categorie === "TOUS") {
            return getObjets(); 
        } else {
            $categorie = mysqli_real_escape_string($db, $categorie); // sécurisation
            $sql = "SELECT * FROM vue_objet_categorie WHERE categorie = '$categorie'";
            $data = mysqli_query($db, $sql);

            $liste = [];
            while ($line = mysqli_fetch_assoc($data)) {
                $retour = $line['retour'] == null ? "Non emprunté" : $line['retour'];
                $liste[] = [
                    'nom' => $line['objet'],
                    'categorie' => $line['categorie'],
                    'retour' => $retour
                ];
            }
            return $liste;
        }
    }

    function contientTexte($texteComplet, $extrait) {
        return strpos($texteComplet, $extrait) !== false;
    }


    function getObjetsWithFiltre($categorie, $nom, $disponibilite){
        $listeParCategorie = getObjetsParCategorie($categorie);
        $liste = [];

        foreach ($listeParCategorie as $o) {
            $disponible = strcmp($o['retour'], "Non emprunté") === 0;

            if ($disponibilite === true && !$disponible)
                continue;
            if ($nom !== '' && !contientTexte($o['nom'], $nom))
                continue;

            $liste[] = $o;
        }

        return $liste;
    }

    function getInfosMembre($nom){
        $db = getDB();
        $sql = "SELECT * FROM emprunts_membre 
                WHERE nom = '$nom'";
        $result = mysqli_query($db, $sql);
        if ($line = mysqli_fetch_assoc($result)){
            $infos = [
                "nom" => $nom,
                "naissance" => $line['date_naissance'],
                "genre" => $line['genre'] === "F" ? "Féminin" : "Masculin",
                "email" => $line['email'],
                "ville" => $line['ville'],
                "image" => $line['image_profil']
            ];
            return $infos;
        }
    }

    function ajoutObjet($nom , $id_categorie, $id_membre){
        $db = getDB();
        $sql = "INSERT INTO emprunts_objet (nom_objet,id_categorie,id_membre) VALUES ('$nom',$id_categorie,$id_membre)";
        mysqli_query($db, $sql);
    }

    function getIDMembre($nom){
        $db = getDB();
        $sql = "SELECT id_membre FROM emprunts_membre WHERE nom = '$nom'";
        $result = mysqli_query($db, $sql);
        if ($line = mysqli_fetch_assoc($result)){
            $id = $line['id_membre'];
            return $id;
        }
    }

    function getObjetsUsedBy($nom){
        $id = getIDMembre($nom);
        $db = getDB();
        $sql = 
        "SELECT 
            o.nom_objet as objet,
            co.nom_categorie as categorie, 
            e.date_emprunt as emprunt,
            e.date_retour as retour
        FROM emprunts_emprunt as e 
        JOIN emprunts_objet as o 
            ON o.id_objet = e.id_objet
        JOIN emprunts_categorie_objet as co 
            ON o.id_categorie = co.id_categorie

        WHERE e.id_membre = $id";

        $result = mysqli_query($db, $sql);
        $liste = [];
        while ($line = mysqli_fetch_assoc($result)) {
            $cat = $line['categorie'];
            if (!isset($liste[$cat])) {
                $liste[$cat] = [];
            }
            $liste[$cat][] = $line;
        }
        return $liste;
    }

    function ajoutImage($nomObjet, $image){
        $db = getDB();
        $idObjet = getIDObjet($nomObjet);
        $sql = "INSERT INTO emprunts_image VALUES($idObjet, '$image')";
        mysqli_query($db, $sql);
    }

    function getIDObjet($nomObjet){
        $db = getDB();
        $sql = "SELECT * FROM emprunts_objet WHERE nom_objet='$nomObjet'";
        $result = mysqli_query($db, $sql);
        if ($line = mysqli_fetch_assoc($result)){
            return $line['id_objet'];
        }
    }

function getObjetByNom($nomObjet) {
    $db = getDB();
    $sql = "SELECT o.id_objet, o.nom_objet, c.nom_categorie as categorie
            FROM emprunts_objet as o
            JOIN emprunts_categorie_objet as c 
                ON o.id_categorie = c.id_categorie
            WHERE o.nom_objet = '$nomObjet'";
    $result = mysqli_query($db, $sql);
    if ($line = mysqli_fetch_assoc($result)) {
        return $line;
    }
    return null;
}

function getImagesObjet($idObjet) {
    $db = getDB();
    $sql = "SELECT image_objet FROM emprunts_image WHERE id_objet = $idObjet";
    $result = mysqli_query($db, $sql);
    $images = [];
    while ($line = mysqli_fetch_assoc($result)) {
        $images[] = $line['image_objet'];
    }
    return $images;
}



    ?>