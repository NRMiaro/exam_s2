<?php 

require("connectDB.php");

function connexionValide($nom, $mdp){
    $db = getDB();
    $sql = "SELECT * FROM emprunts_membre WHERE nom = '$nom' AND mdp = '$mdp'";
    echo $sql;
    $data = mysqli_query($db, $sql);
    if ($line = mysqli_fetch_assoc(($data)))
        return true;
    else return false;
}

?>