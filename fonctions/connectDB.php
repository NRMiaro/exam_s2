<?php 
function getDB(){
    $hostname = 'localhost';
    $username = 'ETU003913';
    $mdp = 'nmR0jD0G';
    $database = "db_s2_ETU003913";
    
    if ($db = mysqli_connect($hostname, $username, $mdp,$database))
        return $db;
}

?>