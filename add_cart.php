<?php
include 'bdd_log.php';
session_start();
/* si un session n'est pas ouvert, redirection vers connexion.php */
if(!isset($_SESSION['customer'])){
    header('Location: connexion.php');
    exit;
}

/* ajoute la sneakers au panier */
if(isset($_SESSION['customer'])) {
  $customer_id = $_SESSION['customer']["Id"];
  $sneakers_id = $_POST['id'];
  $size = $_POST['size'];
  
  $stmt = $db->prepare("INSERT INTO cart (Id_Customer, id_Sneakers, Size) VALUES (?, ?, ?)");
  $stmt->execute([$customer_id, $sneakers_id, $size]);
  
  echo "la Sneakers a bien été ajoutéee au panier";
} else {
   echo "Veuillez vous connecter pour ajouter la Sneakers au panier";
}
?>
