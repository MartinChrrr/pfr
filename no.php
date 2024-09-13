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
        while($row = $verify_match->fetch_assoc()) {
            if($id == $row['user_id2']) {
                $connexion->query("UPDATE matching SET like_user2 = 0");
                header("Location: match.php");

            }
        }
    } else {
        $sql_create = "INSERT INTO matching (user_id1, user_id2, like_user1) VALUES ('$id', '$other_id', 0)";
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