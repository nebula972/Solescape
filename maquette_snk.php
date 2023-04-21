<?php
    session_start();
    
    // Vérifie que l'ID est présent dans l'URL
    if (!isset($_GET['id'])) {
        // Si l'ID n'est pas présent, redirige l'utilisateur vers la page d'accueil
        header("Location: index.php");
        exit();
    }
    
    // Récupère l'ID de la sneaker depuis l'URL
    $sneaker_id = $_GET['id'];
    
    // Stocke l'ID dans une variable de session
    $_SESSION['sneaker_id'] = $sneaker_id;

    /*connexion à la base de données*/
    $db = new PDO('mysql:host=localhost;dbname=Solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Requête pour récupérer les données de la table Sneakers
    $sql = "SELECT Model, Brand, Price, Picture, Description, Filepath, id FROM Sneakers WHERE id = :id";

    // exécute la requête pour récupérer les données de la sneaker
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $sneaker_id);
    $stmt->execute();
    $sneaker = $stmt->fetch();

    /*définition du titre de la page*/
    $title = $sneaker['Brand'] . $sneaker['Model'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" href="assets/image_st/Logo_Solescape.png" type="image/png" sizes="16x16">
    <!--import ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.html';
    ?>
    <!-- end header -->

    <!-- contenu de la page -->
    <section>
        <!-- affiche les info de la sneaker -->
            <?php 
                echo '<div class="snk-choice">';
                echo '<img id="snk-big" src="' . $sneaker['Picture'] . '" alt="' . $sneaker['Model'] . '">';
                echo '<div class="snk-info">';
                echo '<h3 id="snk-name">' . $sneaker['Brand'] . ' ' . $sneaker['Model'] . '</h3>';
                echo '<p id="snk-price">' . $sneaker['Price'] . ' €</p>';
                echo '</div>';
                echo '<label for="size">Sélectionnez votre pointure :</label>';
                        echo '<select id="size" name="size">';
                        echo '<option value="35">35</option>';
                        echo '<option value="36">36</option>';
                        echo '<option value="37">37</option>';
                        echo '<option value="38">38</option>';
                        echo '<option value="39">39</option>';
                        echo '<option value="40">40</option>';
                        echo '<option value="41">41</option>';
                        echo '<option value="42">42</option>';
                        echo '<option value="43">43</option>';
                        echo '<option value="44">44</option>';
                        echo '<option value="45">45</option>';
                        echo '<option value="46">46</option>';
                        echo '<option value="47">47</option>';
                        echo 'option value="48">48</option>';
                        echo '</select>';
                echo '<button onclick="afficherSelection()">Afficher la sélection</button>';
                echo '<div class="snk-snk-but">';
                echo '<button id="add-to-cart" data-id="' . $sneaker['id'] . '">Ajouter au panier</button>';
                echo '<button id="add-to-fav" data-id="' . $sneaker['id'] . '">Ajouter aux favoris</button>';
                echo '<p id="snk-desc">' . $sneaker['Description'] . '</p>';
                echo '</div>';

                // affiche toutes les photos du dossier
                $dir = $sneaker['Filepath'];
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        echo '<img src="' . $dir . '/' . $file . '" alt="' . $sneaker['Model'] . '">';
                    }
                }
                echo '</div>';
            ?>
            <script>
                // Récupération des boutons
                const addToCartButton = document.getElementById('add-to-cart');
                const addToFavoritesButton = document.getElementById('add-to-fav');

                // Ajout d'un écouteur d'événement sur le clic du bouton "Ajouter au panier"
                addToCartButton.addEventListener('click', (event) => {
                    const sneakerId = event.target.dataset.id;
                    // Faire quelque chose avec l'ID de la sneaker, comme l'ajouter au panier
                    alert(`Ajout de la sneaker avec l'ID ${sneakerId} au panier`);
                    afficherSelection();
                });

                // Ajout d'un écouteur d'événement sur le clic du bouton "Ajouter aux favoris"
                addToFavoritesButton.addEventListener('click', (event) => {
                    const sneakerId = event.target.dataset.id;
                    // Faire quelque chose avec l'ID de la sneaker, comme l'ajouter aux favoris
                    alert(`Ajout de la sneaker avec l'ID ${sneakerId} aux favoris`);
                    afficherSelection();
                });
                // Fonction pour afficher la size sélectionnée dans la liste déroulante
                function afficherSelection() {
                    var select = document.getElementById("size");
                    var valeurSelectionnee = select.options[select.selectedIndex].value;
                    alert("La taille sélectionnée est : " + valeurSelectionnee);
                }
                //async add cart 
                $(document).ready(function(){
                    $('#add-to-cart').click(function(){
                        var id = $(this).data("id");
                        var size = $('#size').val();
                        if(size == ''){
                            alert("Please select size");
                            return false;
                        }else{
                            $.ajax({
                                url:"add_cart.php",
                                method:"POST",
                                data:{id:id, size:size},
                                success:function(data){
                                    alert("Product added into cart");
                                }
                            });
                        }
                    });
                });

            </script>
    </section>

    <!-- fin contenu de la page -->

    <!-- footer -->
    <?php 
        include 'footer.html';
    ?>
    <!-- end header -->

</body>
