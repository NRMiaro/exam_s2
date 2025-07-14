<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiktox - Inscription</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">

    <div class="container bg-secondary bg-opacity-75 p-4 rounded shadow" style="max-width: 500px;">
        <h2 class="text-center mb-4">Créer un compte</h2>

        <form action="traitement_signin.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" id="date_naissance" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select name="genre" id="genre" class="form-control" required>
                    <option value="">-- Sélectionnez --</option>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" name="ville" id="ville" class="form-control">
            </div>

            <div class="mb-3">
                <label for="mdp1" class="form-label">Mot de passe</label>
                <input type="password" name="mdp1" id="mdp1" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="mdp2" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="mdp2" id="mdp2" class="form-control" required>
            </div>

            <?php if (isset($_GET['erreurmdp']) && $_GET['erreurmdp'] == 1) { ?>
                <p class="text-danger">Les mots de passe ne correspondent pas.</p>
            <?php } ?>
            <?php if (isset($_GET['erreurmdp']) && $_GET['erreurmdp'] == 2) { ?>
                <p class="text-danger">Nom déjà utilisé.</p>
            <?php } ?>

            <div class="mb-3">
                <label for="image_profil" class="form-label">Image de profil</label>
                <input type="file" name="image_profil" id="image_profil" class="form-control" accept="image/*">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Créer mon compte</button>
            </div>
        </form>

        <div class="text-center my-3">OU</div>

        <div class="d-grid gap-2">
            <a href="login.php" class="btn btn-outline-light">Se connecter</a>
        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
