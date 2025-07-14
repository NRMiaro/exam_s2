<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site d'emprunts</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="text-white d-flex justify-content-center align-items-center vh-100">

    <div class="container p-4 rounded bg-secondary" style="max-width: 400px;">
        <form action="traitement_login.php" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" id="pseudo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe :</label>
                <input type="password" name="mdp" id="mdp" class="form-control" required>
            </div>
            <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1) { ?>
                <p class="text-danger">Informations incorrectes</p>
            <?php } ?>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Se connecter</button>
            </div>
        </form>

        <div class="text-center my-3">OU</div>

        <div class="d-grid gap-2">
            <a href="signin.php" class="btn btn-outline-danger">Créer un compte</a>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
