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


$sql_import = "SELECT * FROM profil WHERE id = '{$id}'";
$import = $connexion->query($sql_import);
$row = $import->fetch_assoc();

// <option value="minuit">00h-3h</option>
// <option value="trois">3h-6h</option>
// <option value="six">6h-9h</option>
// <option value="neuf">9h-12h</option>
// <option value="douze">12h-15h</option>
// <option value="quinze">15h-18h</option>
// <option value="dixhuit">18h-21h</option>
// <option value="vinghtun">21h-00h</option>
$values = array("00h-3h", "3h-6h", "6h-9h", "9h-12h", "12h-15h", "15h-18h", "18h-21h", "21h-00h");
$key = array ( "minuit", "trois", "six" , "neuf", "douze",  "quinze" , "dixhuit", "vingtun");

$tags = array("Nul", "Nulles", "Nulle");

// $horaire = array(
//     $key[0] => $values[0],
//     $key[1] => $values[1],
//     $key[2] => $values[2],
//     $key[3] => $values[3],
//     $key[4] => $values[4],
//     $key[5] => $values[5],
//     $key[6] => $values[6],
//     $key[7] => $values[7],

// );

// $horaire = array(
//     "minuit" => "00h-3h",
//     "trois" => "3h-6h",
//     "six" => "6h-9h",
//     "neuf" => "9h-12h",
//     "douze"=> "12h-15h",
//     "quinze" => "15h-18h",
//     "dixhuit" => "18h-21h",
//     "vingtun" => "21h-00h",

// );



//récupération des données
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $horaire = $_POST["player-horaire"];
    $playerTags = $_POST["player-tags"];
    
    $str_horaire = implode(" ",$horaire);
    $str_tags = implode(" ",$playerTags);
    var_dump($str_horaire);
    var_dump($str_tags);

    $sql_insertProfile = "UPDATE profil SET horaires = '$str_horaire',tags = '$str_tags'  WHERE pseudo = '{$id}'";
        if ($connexion->query($sql_insertProfile) === TRUE) {
            header("Location: ./jeux.php");
        }else{
            echo "Erreur : " . $sql_insert . "<br>" . $connexion->error;
        }


}
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
    <header>
        <h1>Selectionnes des tags</h1>
        <p class="large-regular">Tes futurs amis te trouveront plus facilement <br>en filtrant vos points communs.</p>
    </header>
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
                    "<div class='checkbox-button'>
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
                    "<div class='checkbox-button'>
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
            <input class="primary500" type="submit" placeholder="Continuer">
        </div>



    </form>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="./view/toggle.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>