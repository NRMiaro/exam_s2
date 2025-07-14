<?php
session_start();

include("../fonctions/fonctions.php");

if (!isset($_GET['objet'])) {
    header("Location: accueil.php");
    exit;
}

$objet = $_GET['objet'];
$objetInfos = getObjetByNom($objet);

if (!$objetInfos) {
    echo "Objet inconnu.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['duree'])) {
    $duree = intval($_POST['duree']);

    if ($duree > 0) {
        $idObjet = $objetInfos['id_objet'];
        $nomMembre = $_SESSION['nom'];
        $idMembre = getIDMembre($nomMembre);

        

        emprunter($idObjet, $idMembre, $duree);

        header("Location: fiche_objet.php?objet=" . $objet);
        exit;
    } else {
        echo "Durée invalide.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emprunter <?= htmlspecialchars($objet) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg bg-secondary bg-opacity-75 p-4" style="min-width: 350px;">
            <h4 class="card-title text-center mb-4">Emprunter l'objet</h4>
            <form method="POST" action="emprunter.php?objet=<?= $objet ?>">
                <div class="mb-3">
                    <label for="duree" class="form-label">Combien de jours voulez-vous emprunter <strong><?= $objet ?></strong> ?</label>
                    <input type="number" name="duree" id="duree" class="form-control" min="1" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="fiche_objet.php?objet=<?= $objet ?>" class="btn btn-outline-light">Annuler</a>
                    <button type="submit" class="btn btn-light">Valider l'emprunt</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>