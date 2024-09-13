<?php
require ("phpLogic/config.php");
session_start();
//var_dump($_SESSION);
if ($_SESSION['id'] != null && $_SESSION['id'] != "" && $_SESSION['nom_utilisateur'] != null && $_SESSION['nom_utilisateur'] != "") {
    // Contenu de votre page
    $id = $_SESSION['id'];
    
} else {
    // On retourne sur la page de connexion d'un utilisateur
    //echo "pas bien";
    header("Location:index.php");
}

    
    $other_id = $_GET['other_id'];
    echo   $id ."<br>" . $other_id;

    $sql_import_matching = "SELECT * FROM matching WHERE (user_id1 = '$id' AND user_id2 = '$other_id') OR (user_id2 = '$id' AND user_id1 = '$other_id')";
    $verify_match = $connexion->query($sql_import_matching);
    if($verify_match->num_rows > 0) {
        echo "nulm";
    } else {
        $sql_create = "INSERT INTO matching (user_id1, user_id2, like_user1) VALUES ('$id', '$other_id', 1)";
        if($connexion->query($sql_create) === TRUE){
            header("Location: match.php");
        }
            
        
    }


?>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="./javascript/selection_button.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>