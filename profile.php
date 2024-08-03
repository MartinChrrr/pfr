<?php
require ("phpLogic/config.php");
session_start();
//var_dump($_SESSION);
if ($_SESSION['id'] != null && $_SESSION['id'] != "" && $_SESSION['nom_utilisateur'] != null && $_SESSION['nom_utilisateur'] != "") {
    // Contenu de votre page
    $id = $_SESSION['nom_utilisateur'];
    echo "bien";
} else {
    // On retourne sur la page de connexion d'un utilisateur
    //echo "pas bien";
    header("Location:index.php");
}

    //include("./view/tabBar.php");
?>

<?php

?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Business</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./style/style.css">

</head>

<body>
    <section class="top-bar">
        <h4>Mon Profil</h4>
        <div class="button-top-bar">
            <i class="button-top-bar-icon" data-lucide="pen"></i>
        </div>
        
    </section>



<?php
    include("./view/tabBar.php");
?>
    
    <!-- <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body> -->