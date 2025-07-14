<?php 
session_start();
include("../fonctions/fonctions.php");

if (!isset($_SESSION['nom'])) {
    header("Location: login.php");
    exit();
}

$categories = getCategories();
$i = 1;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un objet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark">

    <?php include("../includes/header.html"); ?>

    <div class="container py-5">
        <div class="card bg-dark bg-opacity-75 shadow-lg  text-white">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">
                    Ajouter un nouvel objet
                </h3>

                <form action="traitement_ajout.php" method="post" enctype="multipart/form-data" class="row g-3">
                    
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom de l'objet :</label>
                        <input type="text" name="nom" id="nom" class="form-control shadow-sm" required>
                    </div>

                    <div class="col-md-6">
                        <label for="categorie" class="form-label">Catégorie :</label>
                        <select name="categorie" id="categorie" class="form-select shadow-sm" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $i; ?>"><?= htmlspecialchars($cat) ?></option>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label for="image" class="form-label">Image de l'objet :</label>
                        <input type="file" name="image" id="image" class="form-control shadow-sm" accept="image/*" required>
                        <?php if (isset($_GET['erreur'])):
                                if ($_GET['erreur'] == "extension"): ?>
                                    <p class="text-danger mt-3 ms-3">Format de fichier invalide</p>
                                <?php endif;
                            endif;
                        ?>

                        
                    </div>

                    <div class="col-12 mt-4 text-center">
                        <button type="submit" class="btn btn-outline-light shadow-sm me-2">
                            Ajouter l'objet
                        </button>
                        <a href="accueil.php" class="btn btn-outline-secondary shadow-sm">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
