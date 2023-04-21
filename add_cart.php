<?php
    session_start();
    //connexion à la base de données
    /*connexion à la base de données*/
    $db = new PDO('mysql:host=localhost;dbname=Solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    var_dump($_POST);
    var_dump($_SESSION);
    var_dump($_GET);
    $id_sh = htmlspecialchars($_POST['id']);
    $id_Customer = htmlspecialchars($_SESSION['id']);
    $size = htmlspecialchars($_POST['size']);
    
    //Requête pour Inserer les données de la table Cart
    $sql = "INSERT INTO Cart (Item_id, id_Customer, Model, size) VALUES ( :Item_id, :id_Customer, :Model, :size)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Item_id', $_POST['id']);
    $stmt->bindParam(':id_Customer', $_POST['id_Customer']);
    $stmt->bindParam(':Model', $_POST['Model']);
    $stmt->bindParam(':size', $_POST['size']);
    $stmt->execute();
    $cart = $stmt->fetch();



    
?>