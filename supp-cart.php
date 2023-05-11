<?php
    include 'bdd_log.php';
    session_start();
    if(!isset($_SESSION['customer'])){
        header('Location: connexion.php');
        exit;
    }
    
    // Récupération de l'id du customer depuis la session
    $customerId = $_SESSION['customer']['Id'];

    // Récuperation des id des sneakers à supprimer
    $cartIds = implode(',', $_POST['cartIds']);
    
    // Suppression des sneakers du panier
    $sql = "DELETE FROM cart WHERE id IN ($cartIds) AND Id_Customer = :customerId";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(':customerId', $customerId);
    $stmt->execute();
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'cartIds' => explode(',', $cartIds)]);
    exit;

?>