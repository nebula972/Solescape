<?php
    include 'bdd_log.php';
    session_start();
    if(!isset($_SESSION['customer'])){
        header('Location: connexion.php');
        exit;
    }
?>
<!--ajax-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        $sql = "SELECT sneakers.*, cart.id as cart_id FROM cart JOIN sneakers ON cart.id_Sneakers = sneakers.id WHERE cart.Id_Customer = :customerId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':customerId', $customerId);
        $stmt->execute();
        $sneakersInCart = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($sneakersInCart)) {
            echo '<div class="empty-cart">
                    <p>Votre panier est vide</p>
                    <a href="Index.php">Retourner à la boutique</a>
                </div>';
        } else {
            echo " <div id='main'>";
            // bouton tout selectionner
            echo "<div class='btn-allselect'>";
            echo "<input type='checkbox' name='allselect' class='checkbox-all' value=''> Tout sélectionner";
            echo "</div>";
            
            // Affichage des résultats dans une grid
            echo "<div class='gallery'>";
            foreach ($sneakersInCart as $row) {
                echo "<a id='sneak-".$row['cart_id']."' href='maquette_snk.php?id=" . $row['id'] . "'>";
                echo "<div class='item'>";
                echo "<input type='checkbox' name='sneaker' data-cartid='" . $row['cart_id'] . "'>";
                echo "<img class='snk-minia' src='" . $row['Picture'] . "' alt='photo_sneakers'>";
                echo "<p class='snk-name'>" . $row['Brand'] . " " . $row['Model'] . "</p>";
                echo "<p class='snk-price'>" . $row['Price'] . "€</p>";
                echo "</div>";
                echo "</a>";
            }
            echo "</div>";

            // Affichage du prix total en javascript
            echo "<div class='total-price'>";
            echo "<p>Total : <span id='total-price'></span>€</p>";
            echo "</div>";

            // Bouton pour supprimer les sneakers du panier
            echo " <div class='container-btn-cart'>";
            echo "<button type='button' class='btn-cart' id='btn-delete'>Supprimer</button>";
            echo "<a href='order.php'><input type='submit'class='btn-cart' name='order' value='Commander'><a/>";
            echo "</div>";
            echo "</div>";
        }
        // Fermeture de la connexion à la base de données
        $db = null;
    ?>
     <!--Suppression des sneakers du panier-->
     <script>
        document.getElementById('btn-delete').addEventListener('click', function() {
            var cartIds = [];
            var checkboxes = document.getElementsByName('sneaker');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    cartIds.push(checkboxes[i].getAttribute('data-cartid'));
                }
            }

            // Si aucun article n'est sélectionné, afficher une alerte
            if (cartIds.length == 0) {
                alert('Veuillez sélectionner au moins un article à supprimer.');
                return;
            }

            // Envoi du tableau de cart_id vers la page de traitement des suppressions en utilisant Ajax
            $.ajax({
                url: 'supp-cart.php',
                type: 'POST',
                data: {
                    cartIds: cartIds
                },
                success: function(data) {
                    // Suppression des sneakers du panier
                    data.cartIds.forEach(function(cartId) {
                        document.getElementById('sneak-' + cartId).remove();
                    });

                    // Calcul du prix total en temps réel
                    const sneakers = document.querySelectorAll('.snk-price');
                    const totalPrice = document.getElementById('total-price');

                    let total = 0;
                    sneakers.forEach((sneaker) => {
                        const price = sneaker.innerHTML;
                        total += parseInt(price);
                    });
                    totalPrice.innerHTML = total;

                    let items = document.getElementsByName('sneaker')
                    if (items.length == 0) {
                        document.getElementById('main').innerHTML = '<div class="empty-cart"><p>Votre panier est vide</p><a href="Index.php">Retourner à la boutique</a></div>';
                    }
                }
            });
        });
    </script>
    <!--Calcul du prix total en temps reel-->

    <script>
        const sneakers = document.querySelectorAll('.snk-price');
        const totalPrice = document.getElementById('total-price');

        let total = 0;
        sneakers.forEach((sneaker) => {
            const price = sneaker.innerHTML;
            total += parseInt(price);
        });
        totalPrice.innerHTML = total;
    </script>

    <?php
        include 'footer.html';
    ?>
    <script>
        const checkboxAll = document.querySelector('.checkbox-all');
        const checkboxes = document.querySelectorAll("input[type='checkbox'][name='sneaker']");

        checkboxAll.addEventListener('change', (event) => {
        const isChecked = event.target.checked;

            checkboxes.forEach((checkbox) => {
                checkbox.checked = isChecked;
            });
        });
    </script>

</body>