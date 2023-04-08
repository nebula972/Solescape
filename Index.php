<?php
    /*connextion à la base de donnée*/
    $db = new PDO('mysql:host=localhost;dbname=Solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    /*fin de la connextion à la base de donnée*/ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solescape - Sneakers limité et authentique</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.html';
    ?>
    <section class="banner-container"><img class="banner" src="assets/image_st/Banner_Solescape.png" alt=""></section>
    <!-- end header -->
    <!-- affichage de la grille des sneakers -->
    <!-- recuperation dans la bdd des infos -->
    <?php
        // Requête pour récupérer les données de la table Sneakers
    $sql = "SELECT Model, Brand, Price, Picture, Link FROM Sneakers";

    // Exécution de la requête
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // fin de la recuperation dans la bdd des infos
    // Affichage des résultats dans un tableau HTML
    echo "<div class='gallery'>";
    foreach ($results as $row) {
        echo "<a href='" . $row['Link'] . "'>";
        echo "<div class='item'>";
        echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
        echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
        echo "<p class='snk-price'>" . $row['Price'] . "€</p>";
        echo "</div>";
        echo "</a>";
    }
    echo "</div>";

    // Fermeture de la connexion à la base de données
    $dbh = null;
    ?>
    <!--<div class="gallery">
            <div class="item">
            <div>photo</div>
            <p class="snk-name">marque et model</p>
            <p class="snk-price">prix<p class="snk-price">
            </div>
    </div>-->



    <?php 
        include 'footer.html';
    ?>
</body>