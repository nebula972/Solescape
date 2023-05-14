<?php
include 'bdd_log.php';
session_start();
    
    // Vérifie que l'ID est présent dans l'URL
    if (!isset($_GET['id'])) {
        // Si l'ID n'est pas présent, redirige l'utilisateur vers la page d'accueil
        header("Location: index.php");
        exit();
    }
    
    // Récupère l'ID de la sneaker depuis l'URL
    $sneaker_id = $_GET['id'];


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
            echo '<img class="img_maq" id="snk-big" src="' . $sneaker['Picture'] . '" alt="' . $sneaker['Model'] . '">';
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
            echo '<div class="snk-snk-but">';
            echo '<button id="add-to-cart" data-id="' . $sneaker['id'] . '">Ajouter au panier</button>';
            echo '<p id="snk-desc">' . $sneaker['Description'] . '</p>';
            echo '</div>';
            // affiche toutes les photos du dossier
            $dir = $sneaker['Filepath'];
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo '<img class="img_maq" src="' . $dir . '/' . $file . '" alt="' . $sneaker['Model'] . '">';
                }
            }
            echo '</div>';
        ?>
       <!--si le client n'est pas connecté, affiche un message d'erreur-->
       <script>
            //async add cart 
            $(document).ready(function(){
                $('#add-to-cart').click(function(){
                    var id = $(this).data("id");
                    var size = $('#size').val();
                    <?php if (!isset($_SESSION['customer'])) {?>
                        alert("Vous devez être connecté pour ajouter un article au panier");
                    <?php } else {?>
                        if(size == ''){
                            alert("Veuillez sélectionner une taille.");
                            return false;
                        }else{
                            $.ajax({
                                url:"add_cart.php",
                                method:"POST",
                                data:{id:id, size:size},
                                success:function(data){
                                    alert("Le produit a été ajouté au panier.");
                                    location.reload();
                                },
                                error:function(){
                                    alert("Une erreur s'est produite. Veuillez réessayer.");
                                }
                            });
                        }
                    <?php } ?>
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
