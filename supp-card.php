<?php
    include 'bdd_log.php';
    //supprime la sneakers du panier
    if(isset($_POST['suppr'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM cart WHERE id_Sneakers = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('Location: panier.php');
        exit;
    }
?>
