<?php
    /*connexion à la base de données*/
    $db = new PDO('mysql:host=localhost;dbname=Solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    /*récupération des données de la sneaker*/
    $sneaker_id = $_GET['id']; //récupération de l'id de la sneaker depuis l'URL
    $sql = "SELECT Model, Brand, Price, Picture FROM Sneakers WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $sneaker_id, PDO::PARAM_INT);
    $stmt->execute();
    $sneaker = $stmt->fetch();

    /*définition du titre de la page*/
    $title = $sneaker['Brand'] . ' ' . $sneaker['Model'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" href="../assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <!-- header -->
    <?php 
        include 'header_2.html';
    ?>
    <!-- end header -->

    <!-- contenu de la page -->

    <!-- fin contenu de la page -->

    <!-- footer -->
    <?php 
        include 'footer_2.html';
    ?>
