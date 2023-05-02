<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.html';
    ?>
    <!-- end header -->

    <!-- contenu de la page -->
    <section class="container-login">
        <div class="form-connexion">
            <form action="connex_action.php" method="post">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" minlength="8" required>
                <input type="submit" value="Se connecter">
                <a href="inscription.php">Pas encore inscrit ?</a>
            </form>
        </div>
    </section>
    <!-- end contenu de la page -->

    <!-- footer -->
    <?php 
        include 'footer.html';
    ?>
    <!-- end footer -->

    <?php
        include 'connex_action.php';
    ?>
    

    
</body>
</html>