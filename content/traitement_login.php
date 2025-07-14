<?php 

session_start();
include ("../fonctions/fonctions.php");

$nom = $_POST['nom'];
$mdp = $_POST['mdp'];

var_dump($_POST);
if (connexionValide($nom, $mdp)){
    $_SESSION['nom'] = $nom;
    header("Location:accueil.php");
    exit();
} else {
    header("Location:login.php?erreur=1");
    exit();
}


?>