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


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $filtres = $_POST["player-horaire"];
    $my_tag = $_POST["player-tags"];
    foreach($my_tag as $_my_tag) {
        array_push($filtres, $_my_tag);
    }
    //var_dump($filtres);

    $profil_id = array();
    $profil_common_tags = array();
    $profil_tags = array();
    $sql_import = "SELECT * FROM profil WHERE id <> '{$id}'";
    $import = $connexion->query($sql_import);
    while($row = $import->fetch_assoc()) {
        array_push($profil_id, $row['id']);
        $increment = 0;
        $otherTags = array();
      
        foreach(explode(" ", $row['tags']) as $tag) {
            array_push($otherTags, $tag);
        }
    
        foreach(explode(" ", $row['horaires']) as $horaire) 
        {
            array_push($otherTags, $horaire);
        }
    
        $profil_common_tags = array_intersect($filtres, $otherTags);
    
    
        array_push($profil_tags, count($profil_common_tags));
        
    
    }
    
    
    
    $order_profil = array();
    
    for($i = 0; $i < count($profil_tags); $i++) {
        $order_profil[$profil_id[$i]] = $profil_tags[$i];
    }
    arsort($order_profil);
    $_SESSION["list-match"] = $order_profil;
    var_dump($_SESSION["list-match"]);
    header("Location: match.php");


}









$values = array("00h-3h", "3h-6h", "6h-9h", "9h-12h", "12h-15h", "15h-18h", "18h-21h", "21h-00h");
$key = array ( "minuit", "trois", "six" , "neuf", "douze",  "quinze" , "dixhuit", "vingtun");

$tags = array("Nul", "Nulles", "Nulle");





?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">

    <title>Ton Profile</title>

</head>

<body>
    <section class="top-bar">
        <a href="javascript:history.go(-1)" class="return-button-top-bar">
            <i class="button-top-bar-icon" data-lucide="arrow-left"></i>
        </a>
        <h4>Sélectionnes des filtres pour trouver des amis</h4>    
    </section>
    <form action="#" method="post">




        <!-- Horaire de jeux
        <div class="field dark2">
            <select name="horaire" id="cars" multiple>
                <option value="minuit">00h-3h</option>
                <option value="trois">3h-6h</option>
                <option value="six">6h-9h</option>
                <option value="neuf">9h-12h</option>
                <option value="douze">12h-15h</option>
                <option value="quinze">15h-18h</option>
                <option value="dixhuit">18h-21h</option>
                <option value="vinghtun">21h-00h</option>
            </select>
        </div> -->


        <p>Horaires De jeux</p>

        <div class="list-checkbox-button">
        <?php
            for($i = 0; $i < count($key); $i++) {
                echo 
                    "<div class='checkbox-button' onclick=toggleCheckbox('". $key[$i] ."')  >
                        <input type='checkbox' name='player-horaire[]' value='" . $key[$i] ."' id ='". $key[$i] . "' >
                        <label for='" . $key[$i] ."'> ". $values[$i]  ."
                        </label>



                    </div>"
                
                
                ;
            }
            ?>


        </div>

        <p>Tags de Jeux</p>

        <div class="list-checkbox-button">
            <?php
            for($i = 0; $i < count($tags); $i++) {
                echo 
                    "<div class='checkbox-button' onclick=toggleCheckbox('". $tags[$i] ."')>
                        <input type='checkbox' name='player-tags[]' value='" . $tags[$i] ."' id ='". $tags[$i] . "' >
                        <label for='" . $tags[$i] ."'> ". $tags[$i]  ."
                        </label>



                    </div>"
                
                
                ;
            }
            ?>
        </div>
        <br><br>
        

        <div class="connexion-button primary500">
            <input class="primary500" type="submit" value="Filtrer">
        </div>



    </form>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="./javascript/selection_button.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>