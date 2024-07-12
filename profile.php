<?php
    require("phpLogic/config.php");
    session_start();
    //var_dump($_SESSION);
    if($_SESSION['id'] != null && $_SESSION['id'] != "" && $_SESSION['nom_utilisateur'] != null && $_SESSION['nom_utilisateur'] != "") {
        // Contenu de votre page
        echo "bien";
    }
    else {
        // On retourne sur la page de connexion d'un utilisateur
        echo "pas bien";
        //header("Location:index.php");
    }



?>