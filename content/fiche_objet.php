<?php
session_start();
include("../fonctions/fonctions.php");

if (!isset($_GET['objet'])) {
    header("Location: accueil.php");
    exit();
}

$nomObjet = $_GET['objet'];
$objet = getObjetByNom($nomObjet); // Fonction à créer (voir plus bas)

if (!$objet) {
    echo "<div class='alert alert-danger text-center'>Objet introuvable.</div>";
    exit();
}

$idObjet = $objet['id_objet'];
$categorie = $objet['categorie'];
$images = getImagesObjet($idObjet);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de <?= htmlspecialchars($nomObjet) ?></title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
    <?php include("../includes/header.html"); ?>

    <div class="container py-5">
        <div class="card bg-secondary bg-opacity-75 shadow text-white">
            <div class="card-body">
                <h2 class="card-title text-center mb-4"><?= $nomObjet ?></h2>

                <div class="row justify-content-center">
                    <?php if (!empty($images)): ?>
                        <?php foreach ($images as $img): ?>
                            <div class="col-md-4 mb-3 text-center">
                                <img src="../assets/images/<?= $img ?>" class="img-fluid rounded shadow">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-md-6 text-center">
                            <img src="../assets/images/<?= $categorie ?>.jpeg" class="img-fluid rounded shadow">
                            <p class="mt-2 text-muted">(Image par défaut de la catégorie)</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="text-center mt-4">
                    <a href="accueil.php" class="btn btn-outline-light">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
