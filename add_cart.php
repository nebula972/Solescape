<?php
    session_start();
    //connexion à la base de données
    /*connexion à la base de données*/
    $db = new PDO('mysql:host=localhost;dbname=Solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    //Requête pour Inserer les données de la table Cart
    $sql = "INSERT INTO Cart (Customer_id, Model, Brand, Price, Picture, Description, Filepath) VALUES (:id, :Model, :Brand, :Price, :Picture, :Description, :Filepath)";


    
?>