<?php
    include 'bdd_log.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solde - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.html';
    ?>
    <section class="banner-container"><img class="banner" src="assets/image_st/Banner_Solescape.png" alt=""></section>

    <div id=btn-solde-container>
        <a href="index.php"><button class="btn-solde">Toutes les Sneakers</button></a>
        <a href="solde.php"><button class="btn-solde">Solde</button></a>
        <a href="incon.php"><button class="btn-solde">Incontournable</button></a>
    </div>

    <?php
        // Requête pour récupérer les données de la table Sneakers
        $sql = "SELECT Model, Brand, Price, Picture, id, Prix_solde FROM Sneakers WHERE Solde = 'soldé'";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // fin de la recuperation dans la bdd des infos
        // Affichage des résultats dans un tableau HTML
        echo "<div class='gallery'>";
        foreach ($results as $row) {
            echo "<a href='maquette_snk.php?id=" . $row['id'] . "'>";
            echo "<div class='item'>";
            echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
            echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
            echo "<p class='snk-price'><span class='original-price'>" . $row['Price'] . "€</span> " . $row['Prix_solde'] . "€</p>";
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";

        $sql = "SELECT Model, Brand, Price, Picture, id, Prix_solde FROM Sneakers WHERE Solde = 'soldé'";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion à la base de données
        $db = null;

        

    ?>

    <?php 
        include 'footer.html';
    ?>
</body>