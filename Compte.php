<?php
    // Inclure le fichier contenant les informations de connexion à la base de données
    include 'bdd_log.php';
    
    // Démarrer une session pour récupérer l'id du client connecté
    session_start();
    if (!isset($_SESSION['customer'])) {
        header("Location: connexion.php");
        exit();
    }
    $customer_id = $_SESSION['customer']['Id'];
    
    // Requête pour récupérer les données du client connecté
    $sql = "SELECT * FROM customer WHERE Id = :id";

    // exécute la requête pour récupérer les données du client
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $customer_id);
    $stmt->execute();
    $customer = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <?php
        include 'Header.html';
    ?>
    <?php
    
    // Vérification que l'utilisateur est connecté en tant qu'admin
    if (isset($_SESSION['customer']['E_mail']) && $_SESSION['customer']['E_mail'] == 'admin@solescape.com') {
        // Afficher le bouton réservé aux admins qui mene vers la page admin.php
        echo "<a href='admin.php' class='btn_admin'>Admin</a>";
    }
?>
    
    <div class="info-container">
        <!--bouton de deconnexion-->
        <a href="logout.php" class="btn_logout">Déconnexion</a>
        <h4 class="info_perso">Mes informations personnelles : <?php echo $_SESSION['customer']['E_mail']; ?></h4>
        <form class="modif_in" action="update_customer.php" method="POST">
            <label class="label_info" for="first_name">Prénom</label>
            <input class="info" type="text" value="<?php echo $customer['First_Name']; ?>" placeholder="Entrez votre prénom" id="First_Name" name="First_Name" require>
            <label class="label_info" for="last_name">Nom</label>
            <input class="info" type="text"value="<?php echo $customer['Last_Name']; ?>" placeholder="Entrez votre nom" id="Last_Name" name="Last_Name"require>
            <label class="label_info" for="email">E-mail</label>
            <input class="info" type="email"value="<?php echo $customer['E_mail']; ?>" id="email" name="E_mail" require>
            <label class="label_info" for="password">Mot de passe</label>
            <input class="info" type="password" placeholder="Modifier votre mot de passe" id="Pwd" name="Pwd" minlength="8" required>
            <label class="label_info" for="street">Rue</label>
            <input class="info" type="text"value="<?php echo $customer['Street']; ?>" placeholder="Entrez votre rue" id="Street" name="Street" require>
            <label class="label_info" for="city">Ville</label>
            <input class="info" type="text"value="<?php echo $customer['City']; ?>" placeholder="Entrez votre ville" id="City" name="City" require>
            <label class="label_info" for="country">Pays</label>
            <input class="info" type="text"value="<?php echo $customer['State']; ?>" placeholder="Entrez votre pays" id="State" name="State" require>
            <label class="label_info" for="postal_code">Code Postal</label>
            <input class="info" type="text"value="<?php echo $customer['Postal_Code']; ?>" placeholder="Entrez votre code postal" id="Postal_Code" name="Postal_Code" require>
            <label class="label_info" for="phone_number">Numéro de téléphone</label>
            <input class="info" type="tel"value="<?php echo $customer['Phone']; ?>" placeholder="Entrez votre numéro de téléphone" id="Phone" name="Phone" require>
            <a href="Compte.php"><input class="sub_info" type="submit" value="Mettre à jour mes informations"></a>
        </form>
    </div>

    <?php
        include 'Footer.html';
    ?>
</body>
</html>