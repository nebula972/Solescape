<?php

    include 'bdd_log.php';

    //si le formulaire est envoyé
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2'])){
        //récupère les données du formulaire
        $email = htmlspecialchars($_POST['email']);
        //hash le mot de passe en sha256
        $password = hash('sha256', $_POST['password']);
        $password2 = hash('sha256', $_POST['password2']);

        //vérifie si les mots de passe correspondent
        if($password == $password2){
            //vérifie si l'email n'existe pas déjà dans la base de données
            $sql = "SELECT * FROM customer WHERE E_mail = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $customer = $stmt->fetch();
            if($customer){
                echo '<script type="text/javascript">';
                echo 'alert("Cette e-mail est déja utiliser");';
                echo 'window.location.href = "inscription.php";';
            echo '</script>';
            }else{
                //insère les données dans la table customer
                $sql = "INSERT INTO customer (E_mail, Pwd) VALUES (:email, :password)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                //enregistre les données de l'utilisateur dans la session
                $_SESSION['customer'] = $customer;
                //redirige vers la page d'accueil après 3 secondes
                header("Location: index.php");
            }
        }else{
            echo '<script type="text/javascript">';
                echo 'alert("les mots de passe ne correspondent pas");';
                echo 'window.location.href = "inscription.php";';
            echo '</script>';
        }
    }
?>