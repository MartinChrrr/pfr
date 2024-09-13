<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    
    <title>Connexion</title>

</head>
<body>
    <h1>App de merde</h1>
    <form action="phpLogic/test.php" method="post">
        <div class="error_connexion">Error</div>
        
        <div class="field dark2">
            <i data-lucide="mail" class="icon-left"></i>
            <input class="dark2" type="text" name="email" placeholder="email">
        </div>
       
        
        <div class="field dark2">
            <i data-lucide="lock-keyhole" class="icon-left"></i>
            <input class="dark2" type="password" name="password" id="password-field" placeholder="Password">
            <i data-lucide="eye-off" class="icon-password" onclick="showPswrd()"  id="eye"></i>
        </div>
        
            <div class="connexion-button primary500">
                <input class="primary500" type="submit" value="Se connecter">
            </div>
        
        <div class="link-connexion medium-regular">
            Vous n'avez pas de compte ? <a href="../index.php">S'inscrire</a>
            
        </div>
        
    </form>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="./view/toggle.js"></script>
    <script>
      lucide.createIcons();
    </script>
</body>
</html>