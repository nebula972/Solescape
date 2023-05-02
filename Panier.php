<?php
    include 'bdd_log.php';
    session_start();
    if(!isset($_SESSION['customer'])){
        header('Location: connexion.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>

    <?php
        include 'header.html';
    ?>

<?php
    // Récupération de l'id du customer depuis la session
    $customerId = $_SESSION['customer']['Id'];   

    // Requête pour récupérer les sneakers dans le panier
    $sql = "SELECT sneakers.* FROM cart JOIN sneakers ON cart.id_Sneakers = sneakers.id WHERE cart.Id_Customer = :customerId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':customerId', $customerId);
    $stmt->execute();
    $sneakersInCart = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // bouton tout selectionner
    echo "<div class='btn-allselect'>";
    echo "<input type='checkbox' name='allselect' value='allselect'> Tout sélectionner";
    echo "</div>";
    
    // Affichage des résultats dans une grid
    echo "<div class='gallery'>";
    foreach ($sneakersInCart as $row) {
        echo "<a href='maquette_snk.php?id=" . $row['id'] . "'>";
        echo "<div class='item'>";
        // encoche pour selectionner la sneaker
        echo "<input type='checkbox' name='sneaker' value='" . $row['id'] . "'>";
        echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
        echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
        echo "<p class='snk-price'>" . $row['Price'] . "€</p>";
        echo "</div>";
        echo "</a>";
    }
    echo "</div>";
    echo " <div class='btn-cart'>";
    echo "<input type='submit' name='supp' value='Supprimer'>";
    echo "<input type='submit' name='order' value='Commander'>";
    echo "</div>";



    // Fermeture de la connexion à la base de données
    $db = null;
    ?>

    <?php
        include 'footer.html';
    ?>

</body>