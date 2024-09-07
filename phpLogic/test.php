<?php
    session_start();
    require("config.php");
    $email = $_POST['email'];
    $password = $_POST['password'];

    // $sql = mysqli_query($connexion, "SELECT * FROM username WHERE email = '{$email}'");
    // if(mysqli_num_rows($sql) > 0){
    //     $row = mysqli_fetch_assoc($sql);
    //     $in_pass = md5($password);
    //     $db_pass = $row['password'];
    //     if($in_pass == $db_pass) {

    //     }
    // }

    $sql = "SELECT * FROM username WHERE email = '{$email}'";
    $verif_email = $connexion->query($sql);
    if($verif_email->num_rows > 0) {
        $row = $verif_email->fetch_assoc();
        $in_pass = md5($password);
        $db_pass = $row['password'];
        if($in_pass == $db_pass) {
            //echo "bien";
            $id = $row['id'];
            $pseudo = $row['pseudo'];
            $_SESSION['id'] = $id;
            $_SESSION['nom_utilisateur'] = $pseudo;
            var_dump($_SESSION);
            header("Location:../profile.php");
        } else {
            echo "email ou mot de passe incorrect";
        }


    } else {
        echo "email ou mot de passe incorrect";
    }
?>