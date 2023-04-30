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
    <title>Recherche - Solescape</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
</head>
<body>
<?php
    include 'Header.html';
?>

<?php
    // récupérer la valeur de 'searchTerm' envoyée par la requête GET
    $searchTerm = $_GET['searchTerm'];

    //requete SQL qui selection tout les produits qui contiennent le terme de recherche
    $sql = "SELECT * FROM sneakers WHERE Brand LIKE ? OR Model LIKE ? OR Color LIKE ? OR Description LIKE ?";

    // Préparation de la requête
    $stmt = $db->prepare($sql);

    // Liaison des paramètres
    $search = "%" . $searchTerm . "%";
    $stmt->bindParam(1, $search, PDO::PARAM_STR);
    $stmt->bindParam(2, $search, PDO::PARAM_STR);
    $stmt->bindParam(3, $search, PDO::PARAM_STR);
    $stmt->bindParam(4, $search, PDO::PARAM_STR);

// Exécution de la requête
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérification s'il y a des résultats
    if (empty($results)) {
        echo "<p>Aucun résultat trouvé pour la recherche : " . $searchTerm . "</p>";
    }else{
        // Affichage des résultats dans un display grid
        echo "<div class='gallery'>";
        foreach ($results as $row) {
            echo "<a href='maquette_snk.php?id=" . $row['id'] . "'>";
            echo "<div class='item'>";
            echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
            echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
            echo "<p class='snk-price'>" . $row['Price'] . "€</p>";
            echo "</div>";
            echo "</a>";
        }
        echo "</div>";
    }


    // Affichage des résultats dans un display grid
    echo "<div class='gallery'>";
    foreach ($results as $row) {
        echo "<a href='maquette_snk.php?id=" . $row['id'] . "'>";
        echo "<div class='item'>";
        echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
        echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
        echo "<p class='snk-price'>" . $row['Price'] . "€</p>";
        echo "</div>";
        echo "</a>";
    }

    // Fermeture de la connexion à la base de données
    $db = null;

echo "</div>";

?>
<?php
    include 'Footer.html';
?>
</body>
</html>