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
        echo $sql;
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



?>