<?php
    // Inclure le fichier contenant les informations de connexion à la base de données
    include 'bdd_log.php';
    
    // Démarrer une session pour récupérer l'id du client connecté
    session_start();
    if (!isset($_SESSION['customer'])) {
        header("Location: connexion.php");
        exit();
    }
    $customer_id = $_SESSION['customer'];
    
    // Requête pour récupérer les informations du client
    $sql = "SELECT * FROM customer WHERE id = :customer";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':customer', $customer_id, PDO::PARAM_INT);
    $stmt->execute();
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    <div class="info-container">
        <!--bouton de deconnexion-->
        <a href="logout.php" class="btn_logout">Déconnexion</a>
        <h4 class="info_perso">Mes informations personnelles</h4>
        <form class="modif_in" action="update_customer.php" method="POST">
            <label class="label_info" for="first_name">Prénom</label>
            <input class="info" type="text" id="First_Name" name="First_Name" require>
            <label class="label_info" for="last_name">Nom</label>
            <input class="info" type="text" id="Last_Name" name="Last_Name"require>
            <label class="label_info" for="email">E-mail</label>
            <input class="info" type="email" id="email" name="E_mail" require>
            <label class="label_info" for="password">Mot de passe</label>
            <input class="info" type="password" id="Pwd" name="Pwd" minlength="8" required>
            <label class="label_info" for="street">Rue</label>
            <input class="info" type="text" id="Street" name="Street" require>
            <label class="label_info" for="city">Ville</label>
            <input class="info" type="text" id="City" name="City" require>
            <label class="label_info" for="country">Pays</label>
            <input class="info" type="text" id="State" name="State" require>
            <label class="label_info" for="postal_code">Code Postal</label>
            <input class="info" type="text" id="Postal_Code" name="Postal_Code" require>
            <label class="label_info" for="phone_number">Numéro de téléphone</label>
            <input class="info" type="tel" id="Phone" name="Phone" require>
            <a href="Compte.php"><input class="sub_info" type="submit" value="Mettre à jour mes informations"></a>
        </form>
    </div>

    <?php
        include 'Footer.html';
    ?>
</body>
</html>