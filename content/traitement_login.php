<?php 

include ("../fonctions/fonctions.php");

$nom = $_POST['nom'];
$mdp = $_POST['mdp'];

var_dump($_POST);
if (connexionValide($nom, $mdp)){
    session_start();
    $_SESSION['nom'] = $nom;
    header("Location:accueil.php");
    exit();
} else {
    header("Location:login.php?erreur=1");
    exit();
}


?>