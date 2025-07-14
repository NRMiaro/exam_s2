<?php 
function getDB(){
    $hostname = 'localhost';
    $username = 'root';
    $mdp = '';
    $database = "gestion_emprunts";
    
    if ($db = mysqli_connect($hostname, $username, $mdp,$database))
        return $db;
}

?>