<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">

    <div class="container bg-secondary bg-opacity-75 p-4 rounded shadow" style="max-width: 400px;">
        <h2 class="text-center mb-4">Se connecter</h2>

        <form action="traitement_login.php" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe</label>
                <input type="password" name="mdp" id="mdp" class="form-control" required>
            </div>

            <?php if (isset($_GET['erreur']) && $_GET['erreur'] == 1) { ?>
                <p class="text-danger">Informations incorrectes.</p>
            <?php } ?>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Se connecter</button>
            </div>
        </form>

        <div class="text-center my-3">OU</div>

        <div class="d-grid gap-2">
            <a href="signin.php" class="btn btn-outline-light">Créer un compte</a>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
