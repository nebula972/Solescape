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
    $password = hash('sha256', $_POST['Pwd']);
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $postal_code = $_POST['Postal_Code'];
    $phone_number = $_POST['Phone'];
    var_dump($_SESSION['customer']['Id']);
    
    // Mise à jour des informations du client dans la base de données
    $sql = "UPDATE Customer SET First_Name = ?, Last_Name = ?, E_mail = ?, Pwd = ?, Street = ?, City = ?, State = ?, Postal_Code = ?, Phone = ? WHERE Id = ?;";
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

    // Mise à jour des informations du client dans la session
    $_SESSION['customer']['First_Name'] = $first_name;
    $_SESSION['customer']['Last_Name'] = $last_name;
    $_SESSION['customer']['E_mail'] = $email;
    $_SESSION['customer']['Pwd'] = $password;
    $_SESSION['customer']['Street'] = $street;
    $_SESSION['customer']['City'] = $city;
    $_SESSION['customer']['State'] = $state;
    $_SESSION['customer']['Postal_Code'] = $postal_code;
    $_SESSION['customer']['Phone'] = $phone_number;

   //redirection vers Compte.php
    header("Location: compte.php");
    die();
?>
