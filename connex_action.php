<?php
session_destroy();

    include 'bdd_log.php';
    //si le formulaire est envoyé
    if(isset($_POST['email']) && isset($_POST['password'])){
        //récupère les données du formulaire
        $email = htmlspecialchars($_POST['email']);
        
        //hash le mot de passe en sha256
        $password = hash('sha256',$_POST['password']);
        //requête pour récupérer les données de la table customer
        $sql = "SELECT * FROM customer WHERE E_mail = :email";

        //exécute la requête pour récupérer les données de l'utilisateur
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $customer = $stmt->fetch();

        //vérifie si l'utilisateur existe
        if($customer){
            //vérifie si le mot de passe est correct
            if($password === $customer['Pwd']){
                //démarre la session
                session_start();
                //enregistre les données de l'utilisateur dans la session
                $_SESSION['customer'] = $customer;
                //redirige vers la page d'accueil
                header("Location: index.php");
            }else{
                //alert js que mpd incorrect
                echo '<script type="text/javascript">';
                 echo 'alert("mot de passe incorrect");';
                 echo 'window.location.href = "connexion.php";';
            echo '</script>';
            }
        }else{
            //alert js que l'utilisateur n'existe pas
            echo '<script type="text/javascript">';
                 echo 'alert("Cet utilisateur n\'existe pas");';
                 echo 'window.location.href = "connexion.php";';
            echo '</script>';
        }
    }
?>