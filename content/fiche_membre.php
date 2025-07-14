<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom'])) {
    header("Location: login.php");
    exit();
}

$nom = $_SESSION['nom'];

$infos = getInfosMembre($nom);
$id = getIDMembre($nom);
$objetsEmpruntes = getObjetsUsedBy($nom);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche membre</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary px-3">
            <div class="container-fluid">
                <a href="logout.php" class="btn btn-light">Se déconnecter</a>
                <a href="fiche_membre.php" class="btn btn-light">Mon profil</a>
            </div>
        </nav>
    </header>

    
    <div class="container py-5">
        <div class="card bg-secondary bg-opacity-75 shadow text-white mx-auto mb-4" style="max-width: 600px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Mon profil</h3>
                
                <?php if (!empty($infos)): ?>
                    <div class="text-center mb-4">
                        <img src="../assets/images/<?= htmlspecialchars($infos['image']) ?>" alt="Image de profil" class="rounded-circle" width="150" height="150">
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-secondary text-white"><strong>Nom :</strong> <?= htmlspecialchars($infos['nom']) ?></li>
                        <li class="list-group-item bg-secondary text-white"><strong>Date de naissance :</strong> <?= htmlspecialchars($infos['naissance']) ?></li>
                        <li class="list-group-item bg-secondary text-white"><strong>Genre :</strong> <?= htmlspecialchars($infos['genre']) ?></li>
                        <li class="list-group-item bg-secondary text-white"><strong>Email :</strong> <?= htmlspecialchars($infos['email']) ?></li>
                        <li class="list-group-item bg-secondary text-white"><strong>Ville :</strong> <?= htmlspecialchars($infos['ville']) ?></li>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-danger text-center">Impossible de charger les informations du membre.</div>
                    <?php endif; ?>
            </div>
        </div>

        <!-- Tableau des objets empruntés groupés par catégorie -->
        <div class="card bg-secondary bg-opacity-75 shadow text-white mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Objets empruntés</h4>
                <?php if (!empty($objetsEmpruntes)): ?>
                    <?php foreach ($objetsEmpruntes as $categorie => $objets): ?>
                        <h3 class="mt-4"><?= $categorie ?>:</h3>
                        <table class="table table-striped table-dark table-hover mt-2">
                            <thead>
                                <tr>
                                    <th>Nom de l'objet</th>
                                    <th>Date d'emprunt</th>
                                    <th>Date de retour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($objets as $objet): ?>
                                    <tr>
                                        <td><?= $objet['objet'] ?></td>
                                        <td><?= $objet['emprunt'] ?></td>
                                        <td><?= $objet['retour'] === null ? '-' : $objet['retour'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center">Aucun objet emprunté.</p>
                                <?php endif; ?>
            </div>
        </div>
                        
    </div>

    <button class="btn btn-light" onclick="location.href='accueil.php'">Accueil</button>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
