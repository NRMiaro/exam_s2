<?php
session_start();
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom'])) {
    header("Location: login.php");
    exit();
}

$DOSSIER = "assets/images";

$nom = $_SESSION['nom'];
$id_membre = getIDMembre($nom);

$nom_objet = $_POST['nom'];
$id_categorie = $_POST['categorie'];

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $allowed_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (in_array($ext, $allowed_ext)) {
        $new_name = 'img_' . uniqid() . '.' . $ext;
        $dest = "../assets/images/" . $new_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
            ajoutObjet($nom_objet, $id_categorie, $id_membre);
            ajoutImage($nom_objet, $new_name);
            header("Location:accueil.php?ok=3");
        } else {
            header("Location:ajout.php?erreur=upload");
        }
    } else {
        header("Location:ajout.php?erreur=extension");
    }
}

// exit();

?>
