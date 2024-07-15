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
$sql_jeux = "SELECT * FROM jeux";
$result = $connexion->query($sql_jeux);
echo '<form action="">
<div class="liste-jeux">';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        echo '<div class="jeu">
        <input type="checkbox" id="'
        . $row['id'] .'" />
        <label for="'. $row['id'] .'"><img src="'. $row['image'] .' "/></label>
        </div>';
    }


}


?>

</div>
</form>
