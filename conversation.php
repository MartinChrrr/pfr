<?php
    $conv_id = $_GET['id'];
    //var_dump( $conv_id);
    require ("phpLogic/config.php");
    session_start();
//var_dump($_SESSION);
    if ($_SESSION['id'] != null && $_SESSION['id'] != "" && $_SESSION['nom_utilisateur'] != null && $_SESSION['nom_utilisateur'] != "") {
    // Contenu de votre page
        $id = $_SESSION['nom_utilisateur'];
        $sessID = $_SESSION['id'];
    //echo "bien";
    } else {
    // On retourne sur la page de connexion d'un utilisateur
    //echo "pas bien";
        header("Location:index.php");
    }


    if($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_SESSION['form_submitted'])) {
        $message = $_POST['message'];
        if(isset($message)) {

            $sql_input_message = "INSERT INTO messages (conv_id, id_user, message) VALUES ('$conv_id','$sessID', '$message') ";
            if ($connexion->query($sql_input_message) === TRUE) {
                echo $sql_input_message;
            }
            $lastMessage = $_SESSION['nom_utilisateur'] . ": " . substr($message,0,15);
            $sql_last_message = "UPDATE conversation SET messages='$lastMessage' WHERE id='$conv_id'";
            if ($connexion->query($sql_last_message) === TRUE) {
                $_SESSION['message'] = $message;
                $_SESSION['form_submitted'] = true;
                header("Location: conversation.php?id=" . $conv_id);
                unset($_SESSION['message']);

                unset($_SESSION['form_submitted']);

                exit;
            }

       
        }

    }

    $idUsers = array();
    $messages = array();


    $sql_contact_import = "SELECT * FROM conversation WHERE id = '$conv_id'";
    $contact = $connexion->query($sql_contact_import);
    if($contact ->num_rows > 0) {
        while($row = $contact->fetch_assoc()) {
           
            if($row['id_user1'] == $sessID) {
                $id_user2 = $row['id_user2'];
            } else {
                $id_user2 = $row['id_user1'];
            }
        }
    }

    $sql_other_profil = "SELECT pseudo, photo FROM profil WHERE id = '$id_user2'";
    var_dump($id_user2);
    $sql_result = $connexion->query($sql_other_profil);
    if($sql_result ->num_rows > 0) {
        while($row = $sql_result->fetch_assoc()) {
           $otherPhoto = $row['photo'];
           $otherName = $row['pseudo'];
        }
    }


    $sql_messages_import = "SELECT * FROM messages WHERE conv_id = '$conv_id'";
    $result = $connexion->query($sql_messages_import);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // if($conv_id == $row['conv_id']) {
            //     echo "test";
            // } else {
            //     echo "bad";
            // }
            // var_dump($row);
            array_push($messages, $row['message']);
            array_push($idUsers, $row["id_user"]);
        }
    } 
    echo count($messages);


?>





<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv="refresh" content="5"> -->
   <!-- Recharge la page toutes les 5 secondes -->
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
        <a href="./chat.php" class="return-button-top-bar">
            <i class="button-top-bar-icon" data-lucide="arrow-left"></i>
        </a>
        <h4>Chats</h4>
        <div class="button-top-bar">
            <i class="button-top-bar-icon" data-lucide="mail"></i>
        </div>
    </section>

    <a href="other.php?id=<?php echo $id_user2?>"  class="other-conv">
        <img src="<?php echo $otherPhoto?>" alt="Image de profil de <?php echo $otherName?>">
        <h4><?php echo $otherName?></h4>
    </a>

    <div class="messages-container">

    <?php
        for($i = 0; $i < count($idUsers); $i++) {
            if($idUsers[$i] == $sessID) {
                echo "<div class='chat outgoing'>
                    <p>" . $messages[$i] ."</p>
                
                </div>
                ";
            } else {
                echo "<div class='chat incoming'>
                <img src=". $otherPhoto. " alt='Image de profil de ". $otherName."'>
                <p>" . $messages[$i] ."</p>
            
            </div>
            ";
            }



        }

    ?>
    </div>
    <br><br><br>





    <navbar class="message-bar">
        <form action="#" method="post">
         
            <textarea class="dark2" type="text" name="message" placeholder="Ecrire une message"></textarea>
           
            <label for="message-sender" class="label-input"> <i class="button-top-bar-icon" data-lucide="send"></i></label>
            <input class="primary500"  type="submit" id="message-sender" placeholder="Continuer">
        </form>

    </navbar>


    <!-- <script src="./view/chat.js"></script> -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>