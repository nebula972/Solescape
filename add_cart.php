<?php
include 'bdd_log.php';
/* ajoute la sneakers au panier */
if(isset($_SESSION['customer'])) {
  $customer_id = $_SESSION['customer']["Id"];
  $sneakers_id = $_POST['id'];
  $size = $_POST['size'];
  var_dump($_POST);
  
  $stmt = $db->prepare("INSERT INTO cart (Id_Customer, id_Sneakers, Size) VALUES (?, ?, ?)");
  $stmt->execute([$customer_id, $sneakers_id, $size]);
  
  echo "la Sneakers a bien été ajoutée au panier";
} else {
   var_dump($_SESSION);
}
?>
