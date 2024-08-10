<?php
require ("phpLogic/config.php");
session_start();
//var_dump($_SESSION);
if ($_SESSION['id'] != null && $_SESSION['id'] != "" && $_SESSION['nom_utilisateur'] != null && $_SESSION['nom_utilisateur'] != "") {
    // Contenu de votre page
    $id = $_SESSION['nom_utilisateur'];
    //echo "bien";
} else {
    // On retourne sur la page de connexion d'un utilisateur
    //echo "pas bien";
    header("Location:index.php");
}

    //include("./view/tabBar.php");
?>

<?php
    $id = $_SESSION['id'];

    $defaultMessage = "Vous venez de match";
   
    $otherID = array();
    $otherPictures = array();
    $otherName = array();
    $messages = array();
    $heures = array();
    $convIDs = array();


    $date = date("h:i");
    //date('Y-m-d' ,strtotime($_POST["birthday"]))
    var_dump($date);


    $sql_id = "SELECT * FROM conversation WHERE id_user1 = '{$id}' OR id_user2= '$id'";
    $result = $connexion->query($sql_id);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($convIDs, $row["id"]);
            if($row['messages'] != null || $row['messages'] != "") {
                array_push($messages, $row['messages']);
            } else {
                array_push($messages, $defaultMessage);
            }
            if($row['heure'] != null || $row['heure'] != "") {
                array_push($messages, $row['heure']);
            } else {
                array_push($heures, $date);
            }
            if ($id == $row['id_user1']) {
                array_push($otherID, $row['id_user2']);
            } else {
                array_push($otherID, $row['id_user1']);
            }

    
        }
    }
    
    var_dump($convIDs);

    foreach($otherID as $i) {
        $sql ="SELECT pseudo, photo FROM profil WHERE id = '$i'";
        $r = $connexion->query($sql);
        if($r->num_rows > 0) {
            while($row = $r->fetch_assoc()) {
                array_push($otherPictures, $row['photo']);
                array_push($otherName, $row['pseudo']);
            }
        } 
    }




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
        <h4>Chats</h4>
        <div class="button-top-bar">
            <i class="button-top-bar-icon" data-lucide="mail"></i>
        </div>
    </section>
    <a href="./conversation.php?id='1'">nul</a>

    <div class="list-chats">
        <?php
            for ($i = 0; $i < count($otherID); $i++){
                echo "
                <div class='chat-card'>
                   <img src= '". $otherPictures[$i] ."'>
                   <a href='conversation.php?id=". $convIDs[$i]."' class='chat-card-text'>
                       <h5>". $otherName[$i]  ." </h5> 
                        <p class='medium-regular greyscale300'>". $messages[$i] ."</p>
                    </a>
                    <p class='heure'> ". $heures[$i]." </p> 
                </div>
                
                ";
            }



        ?>
        <br><br>
    </div>



        


<?php
    include("./view/tabBar.php");
?>