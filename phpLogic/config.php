<?php
// Variables de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetfilrouge";

//initialisation de la connexion
$connexion = new mysqli($servername, $username, $password, $dbname);

//vérification effectuée lors de la connexion
if($connexion->connect_error) {
    die("Echec de la connexion : " . $connexion->connect_error);
}

?>