<?php
    include 'bdd_log.php';
    session_start();
    
    // Vérification que l'utilisateur est connecté
    if (!isset($_SESSION['customer'])) {
        header("Location: connexion.php");
        exit();
    }
    
    // Récupération des valeurs du formulaire
    $first_name = $_POST['First_Name'];
    $last_name = $_POST['Last_Name'];
    $email = $_POST['E_mail'];
    $password = $_POST['Pwd'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $postal_code = $_POST['Postal_Code'];
    $phone_number = $_POST['Phone'];
    
    // Mise à jour des informations du client dans la base de données
    $sql = "UPDATE customer SET First_Name = ?, Last_Name = ?, E_mail = ?, Pwd = ?, Street = ?, City = ?, State = ?, Postal_Code = ?, Phone = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $first_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $last_name, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);
    $stmt->bindParam(4, $password, PDO::PARAM_STR);
    $stmt->bindParam(5, $street, PDO::PARAM_STR);
    $stmt->bindParam(6, $city, PDO::PARAM_STR);
    $stmt->bindParam(7, $state, PDO::PARAM_STR);
    $stmt->bindParam(8, $postal_code, PDO::PARAM_STR);
    $stmt->bindParam(9, $phone_number, PDO::PARAM_STR);
    $stmt->bindParam(10, $_SESSION['customer']['Id'], PDO::PARAM_INT);
    $stmt->execute();

   //redirection en javascript vers Compte.php
    echo "<script type='text/javascript'>document.location.replace('Compte.php');</script>";
    die();
?>
