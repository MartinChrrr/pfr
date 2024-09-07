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


$sql_import = "SELECT * FROM profil WHERE id = '$id'";
$import = $connexion->query($sql_import);
if($import->num_rows > 0) {
    echo "test";
    $row = $import->fetch_assoc();
    //var_dump($row);
    $donneeGenre = $row['genre'];
    $donneeBio = $row['biographie'];
    $donneeStream = $row['stream'];
    $donneeTags = explode(" ", $row['tags']);
    $donneeHoraires = explode(" ", $row['horaires']);
    
}

$values = array("00h-3h", "3h-6h", "6h-9h", "9h-12h", "12h-15h", "15h-18h", "18h-21h", "21h-00h");
$key = array ( "minuit", "trois", "six" , "neuf", "douze",  "quinze" , "dixhuit", "vingtun");

$tags = array("Nul", "Nulles", "Nulle");



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
            header("Location: ./profile.php");
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

    <p>Genre</p>
        <div class="field dark2">
            <select class="dark2" name="genre">


                <option value="panda"             
                <?php
                    if($donneeGenre == "panda") echo " selected ";
                ?>
                >
                Panda</option>
                <option value="humain"
                <?php
                    if($donneeGenre == "humain") echo " selected ";
                ?>
                >
                >Humain</option>
                <option value="robot"                 
                <?php
                    if($donneeGenre == "robot") echo " selected ";
                ?>
                >Robot</option>

            </select>
        </div>



        <p>Image</p>
        <div class="field dark2">

            <input class="dark2" type="file" accept="image/*" name="image">

        </div>

<!-- 

        <p>Date de naissance</p>
        <div class="field dark2">

            <input class="dark2" type="date" name="birthday" >

        </div> -->

        <p>Bio</p>
        <div class="field dark2">
            <textarea class="dark2" type="text" name="bio" placeholder="Ecriver une bio." rows="5"><?php echo $donneeBio ;?></textarea>
        </div>

        <p>Stream</p>
        <div class="field dark2">
            <textarea class="dark2" type="text" name="stream" placeholder="Ton lien Twitch" rows="1"><?php echo $donneeStream;?></textarea>
        </div>
        <p>Horaires De jeux</p>

        <div class="list-checkbox-button">
        <?php
            for($i = 0; $i < count($key); $i++) {
                echo 
                    "<div class='checkbox-button'>
                        <input type='checkbox' name='player-horaire[]' value='" . $key[$i] ."' id ='". $key[$i] . "'";
                for($j = 0; $j < count($donneeHoraires); $j++ ) {
                    if($key[$i] == $donneeHoraires[$j]) {
                        echo " checked ";
                    }
                }       
                        
                echo ">
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
                echo "<div class='checkbox-button'>
                <input type='checkbox' name='player-tags[]' value='" . $tags[$i] ."' id ='". $tags[$i] . "' " ; 
                for($j = 0; $j < count($donneeTags); $j++) {
                    

                        if($tags[$i] == $donneeTags[$j]) {
                            echo " checked ";
                        }

                    
                }
                echo "' >
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