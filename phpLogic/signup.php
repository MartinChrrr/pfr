<?php
session_start();
include("config.php");


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = uniqid();
    $pseudo = $_POST["pseudo"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $passwrd = $_POST["password"];
    $enc_pass = md5($passwrd);
    //$enc_pass = $passwrd;
    if(!empty($id) && !empty($pseudo) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($enc_pass)) {

        $sql_insert = "INSERT INTO username (id, pseudo, email, password, nom, prenom) VALUES ('$id', '$pseudo','$email', '$enc_pass' ,  '$nom', '$prenom')";
        $sql_insertProfile = "INSERT INTO profil (id, pseudo) values ('$id', '$pseudo')";

        $sql_email = "SELECT * FROM username WHERE email = '{$email}'";
        $verif_email = $connexion->query($sql_email);
        $sql_pseudo = "SELECT * FROM username WHERE pseudo = '{$pseudo}'";
        $verif_pseudo = $connexion->query($sql_pseudo);
        if($verif_email->num_rows == 0) {
            if($verif_pseudo->num_rows == 0) {
                // Exécuter la requête d'insertion
                if ($connexion->query($sql_insert) === TRUE && $connexion->query($sql_insertProfile) === TRUE) {
                    echo "Nouvel enregistrement ajouté avec succès.";
                    $_SESSION['id'] = $id;
                    $_SESSION['nom_utilisateur'] = $pseudo;
                    header("Location:../inscription2.php");
                } else {
                    echo "Erreur : " . $sql_insert . "<br>" . $connexion->error;
                }
            } else {
                echo "Pseudo déjà utilisé"; 
            }


        } else {
            echo "Email déjà utilisé";
        }
        


    }
}

?>