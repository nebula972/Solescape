<?php
    // Inclus le fichier contenant les informations de connexion à la base de données
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
    <title>Commander - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <?php
        include 'Header.html';
    ?>

    <div class="info-container">
    <h4 class="info_perso">Information de livraison</h4>
    <form class="modif_in" action="conf.php" method="POST">
        <label class="label_info" for="first_name">Prénom :</label>
        <input class="info" type="text" value="<?php echo $customer['First_Name']; ?>" placeholder="Entrez votre prénom" id="First_Name" name="First_Name" required>

        <label class="label_info" for="last_name">Nom :</label>
        <input class="info" type="text" value="<?php echo $customer['Last_Name']; ?>" placeholder="Entrez votre nom" id="Last_Name" name="Last_Name" required>

        <label class="label_info" for="street">Rue :</label>
        <input class="info" type="text" value="<?php echo $customer['Street']; ?>" placeholder="Entrez votre rue" id="Street" name="Street" required>

        <label class="label_info" for="city">Ville :</label>
        <input class="info" type="text" value="<?php echo $customer['City']; ?>" placeholder="Entrez votre ville" id="City" name="City" required>

        <label class="label_info" for="country">Pays :</label>
        <input class="info" type="text" value="<?php echo $customer['State']; ?>" placeholder="Entrez votre pays" id="State" name="State" required>

        <label class="label_info" for="postal_code">Code Postal :</label>
        <input class="info" type="text" value="<?php echo $customer['Postal_Code']; ?>" placeholder="Entrez votre code postal" id="Postal_Code" name="Postal_Code" required>

        <label class="label_info" for="phone_number">Numéro de téléphone :</label>
        <input class="info" type="tel" value="<?php echo $customer['Phone']; ?>" placeholder="Entrez votre numéro de téléphone" id="Phone" name="Phone" required><br><br>

        <h4 class="info_perso">Information de paiement</h4>

        <label class="label_info" for="cb_code">Numéro de carte bancaire :</label>
        <input class="info" type="text" placeholder="1234 5678 9000 0000" id="cb_code" name="cb_code" maxlength="16" minlength="16" required>

        <label class="label_info" for="name_cb">Nom sur la carte :</label>
        <input class="info" type="text" placeholder="Prenom Nom" id="name_cb" name="name_cb" required>

        <label class="label_info" for="date_exp">Date expiration (mm/aa) :</label>
        <input class="info" type="text" placeholder="mm/aa" maxlength="5" minlength="5" require>

        <label class="label_info" class="label_info" for="cb_cryp">Cryptogramme visuel</label>
        <input class="info" class="info" type="password" placeholder="123" maxlength="3"  minlength="3" require>

        <a href="Conf.php"><input class="sub_info" type="submit" value="Commander"></a>

    </form>
    </div>

    <?php
        include 'Footer.html';
    ?>
    
</body>
</html>