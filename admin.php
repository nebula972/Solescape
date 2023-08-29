<?php
    include 'bdd_log.php';
    session_start();
    // Vérifier si l'utilisateur est connecté et son email n'est pas "admin@solescape.com"

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.html';
    ?>
    <section class="banner-container"><img class="banner" src="assets/image_st/Banner_Solescape.png" alt=""></section>

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
            echo "<p class='snk-price'>" . $row['Price'] .' '. $row['Prix_solde'] . "€</p>";
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";

        $sql = "SELECT COUNT(*) AS total_sneakers_sold
        FROM sneakers
        WHERE solde = 'soldé';
        ";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $nbsoldsnk = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        $sql = "SELECT COUNT(*) AS total_sneakers
        FROM sneakers;
        ";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $nbsnk = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT AVG(Price) AS prix_moyen_soldes
        FROM sneakers
        WHERE solde = 'soldé';
        ";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $prixsnk = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT AVG(Price) AS prix_moyen_incon
        FROM sneakers
        WHERE solde = 'non';
        ";

        // Exécution de la requête
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $prix2snk = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <div class="nb-snk">
            <p>Nombre de sneakers total : <?php echo $nbsnk[0]['total_sneakers']; ?></p>
            <p>Nombre de sneakers soldées : <?php echo $nbsoldsnk[0]['total_sneakers_sold']; ?></p>
            <p>Prix moyen des sneakers soldées : <?php echo $prixsnk[0]['prix_moyen_soldes']; ?>€</p>
            <p>Prix moyen des sneakers incontournable : <?php echo $prix2snk[0]['prix_moyen_incon']; ?>€</p>

        </div>
    <?php
        // Fermeture de la connexion à la base de données
        $db = null;

        

    ?>

    <?php 
        include 'footer.html';
    ?>
</body