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


//récupération des données
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_input = $_POST["pseudo"];
    $genre = $_POST["genre"];
    //$horaire = $_POST["horaire"];
    
    $birthday = date('Y-m-d' ,strtotime($_POST["birthday"]));
    var_dump($birthday);
    $bio = $_POST["bio"];
    $stream = $_POST["stream"];
    if(isset($_FILES['image'])) {
        // $img_name = $_FILES['image']['name'];
        // $img_type = $_FILES['image']['type'];
        // $tmp_name = $_FILES['image']['tmp_name'];

        // $img_explode = explode('.', $img_type);
        // $img_end = end($img_explode);
        $target_dir = "./images/profile/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
    }
    if($id === $id_input) {
        $sql_insertProfile = "UPDATE profil SET biographie = '$bio', birthday = '$birthday', stream = '$stream' , genre = '$genre' 
        WHERE pseudo = '{$id}'";
        if ($connexion->query($sql_insertProfile) === TRUE) {
            header("./profile.php");
        }else{
            echo "Erreur : " . $sql_insert . "<br>" . $connexion->error;
        }
    } else {
        echo 'nul';
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
    <h1>App de merde</h1>
    <form action="#" method="post">

        <p>Pseudo</p>
        <div class="field dark2">

            <input class="dark2" name="pseudo" type="text" value="<?php echo $_SESSION['nom_utilisateur'] ?>" required
                autocomplete="off" >
        </div>
        <p>Genre</p>
        <div class="field dark2">
            <select class="dark2" name="genre">


                <option value="panda">Panda</option>
                <option value="humain">Humain</option>
                <option value="robot">Robot</option>

            </select>
        </div>

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

        <p>Image</p>
        <div class="field dark2">

            <input class="dark2" type="file" accept="image/*" name="image">

        </div>



        <p>Date de naissance</p>
        <div class="field dark2">

            <input class="dark2" type="date" name="birthday" >

        </div>

        <p>Bio</p>
        <div class="field dark2">
            <textarea class="dark2" type="text" name="bio" placeholder="Ecriver une bio." rows="5"></textarea>
        </div>

        <p>Stream</p>
        <div class="field dark2">
            <textarea class="dark2" type="text" name="stream" placeholder="Ton lien Twitch" rows="1"></textarea>
        </div>


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