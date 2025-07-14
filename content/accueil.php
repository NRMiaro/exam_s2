<?php 
session_start();
include("../fonctions/fonctions.php");

$categorieSelectionnee = $_GET['categorie'] ?? "TOUS";
$extraitNom = $_GET['nom'] ?? '';
$disponibilite = isset($_GET['disponible']) ? true : false;
$listeObjets = getObjetsWithFiltre($categorieSelectionnee, $extraitNom, $disponibilite);
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
        
        <div class="card bg-secondary bg-opacity-75 text-white mb-4 shadow">
            <div class="card-body">
                <form action="accueil.php" method="get" class="row g-3 align-items-end">
                    <div class="col-md-4">
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

                    <div class="col-md-4">
                        <label for="nom" class="form-label">Nom de l'objet :</label>
                        <input type="text" name="nom" id="nom" value="<?= $extraitNom ?>" class="form-control">
                    </div>

                    <div class="col-md-2 form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="disponible" id="disponible" <?= $disponibilite ? 'checked' : '' ?>>
                        <label class="form-check-label" for="disponible">Disponible uniquement</label>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-light">Appliquer</button>
                    </div>

                    <div class="col -md-auto">
                        <a href="ajout.php" class="btn btn-primary">Ajouter un objet</a>
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
                                    <tr onclick="location.href='fiche_objet.php?objet=<?= $o['nom'] ?>'">
                                        <td><?= $o['nom'] ?></td>
                                        <td>
                                            <?= $o['retour'] ?>
                                            <?php if ($o['retour'] == "Non emprunté"): ?>
                                                <a href="emprunter.php?objet=<?= $o['nom'] ?>" class="btn btn-danger ms-5">Emprunter</a>
                                            <?php endif; ?>
                                        </td>
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
