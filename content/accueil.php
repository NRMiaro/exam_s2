<?php 

session_start();
include("../fonctions/fonctions.php");
$listeObjets = getObjets();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <p>Bonjour, <?= $_SESSION['nom'] ?></p>
    <main>
        <div class="container">
            <table>
                <tr>
                    <th>Objet</th>
                    <th>Date de retour</th>
                </tr>
                <?php foreach ($listeObjets as $o) {
                    $nom = $o['objet'];
                    $retour = $o['retour'];
                ?>
                <tr>
                    <td><?= $nom ?></td>
                    <td><?= $retour ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </main>
</body>
</html>