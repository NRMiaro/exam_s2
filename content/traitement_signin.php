<!-- <?php 

include ("../fonctions/fonctions.php");
session_start();
var_dump($_POST);

// check si les deux mdp entrés sont les mêmes 

$mdp1 = $_POST['mdp1'];
$mdp2 = $_POST['mdp2'];
$ville = $_POST['ville'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$genre = $_POST['genre'];
$naissance = $_POST['date_naissance'];

if (strcmp($mdp1, $mdp2) != 0){
    header("Location:signin.php?erreurmdp=1");
    exit();
}
if (isUnusedPseudo($nom)){
    addUser($nom, $mdp1,$email,$ville,$genre,$image,$naissance);
    $_SESSION['nom'] = $nom;
    header("Location:accueil.php");
    exit();
}
else {
    header("Location:signin.php?erreurmdp=2");
    exit();
} 


?> -->
