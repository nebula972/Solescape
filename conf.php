<?php
    include 'bdd_log.php';
    session_start();
    //verifie si le client est connecté
    if(!isset($_SESSION['customer'])){
        header('Location: connexion.php');
        exit;
    }
    
    $customerId = $_SESSION['customer']['Id'];
    
    // Vérifier si le panier est vide
    $sql = "SELECT COUNT(*) FROM cart WHERE Id_Customer = :customerId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':customerId', $customerId);
    $stmt->execute();
    $cartItemCount = $stmt->fetchColumn();
    
    if($cartItemCount == 0) {
        header('Location: index.php');
        exit;
    }else{
        // Récupération de l'id du customer depuis la session
    $customerId = $_SESSION['customer']['Id'];
    // Requête pour supprimer les sneakers dans le panier
    $sql = "DELETE FROM cart WHERE Id_Customer = :customerId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':customerId', $customerId);
    // Exécution de la requête
    if($stmt->execute()){
        // Affichage d'un message de confirmation
        echo "<h2 style='color: purple; font-size: 24px; text-align: center;'>Votre commande a bien été confirmée.</h2>";
        header('Refresh: 5; URL=index.php');
    } else {
        // Affichage d'un message d'erreur
        echo "Une erreur est survenue lors de la confirmation de votre commande.";
    }
    exit;
    }
?>