<?php
    // si une session es déjà ouverte, on la ferme
    if (session_status() == PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    //connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>