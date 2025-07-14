<?php 
session_start();
include("../fonctions/fonctions.php");

$categorieSelectionnee = $_GET['categorie'] ?? "TOUS";
$listeObjets = getObjetsParCategorie($categorieSelectionnee);
$categories = getCategories(); // Doit retourner un tableau simple de noms
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">

    <?php include("../includes/header.html"); ?>

    <div class="container py-5">
        
        <!-- Filtrage par catégorie -->
        <div class="card bg-secondary bg-opacity-75 text-white mb-4 shadow">
            <div class="card-body">
                <form action="accueil.php" method="get" class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Filtrer par catégorie :</label>
                        <select name="categorie" id="categorie" class="form-select">
                            <option value="TOUS" <?= $categorieSelectionnee === "TOUS" ? "selected" : "" ?>>-- Toutes catégories --</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>" <?= $categorieSelectionnee === $cat ? "selected" : "" ?>>
                                    <?= htmlspecialchars($cat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-light">Appliquer</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des objets -->
        <div class="card bg-secondary bg-opacity-75 shadow">
            <div class="card-body">
                <h4 class="card-title mb-4">Objets empruntés</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-hover table-bordered mb-0">
                        <thead class="table-light text-dark">
                            <tr>
                                <th>Objet</th>
                                <th>Date de retour</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listeObjets as $o): ?>
                                <tr>
                                    <td><?= htmlspecialchars($o['nom']) ?></td>
                                    <td><?= htmlspecialchars($o['retour']) ?: '—' ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($listeObjets)): ?>
                                <tr>
                                    <td colspan="2" class="text-center">Aucun objet dans cette catégorie.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
