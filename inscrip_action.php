<!-- php pour l'inscription -->
<?php

    include 'bdd.php';

    //connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=solescape;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

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
                echo 'Cet email est déjà utilisé';
            }else{
                //insère les données dans la table customer
                $sql = "INSERT INTO customer (E_mail, Pwd) VALUES (:email, :password)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo 'Inscription réussie !';
            }
        }else{
            echo 'Les mots de passe ne correspondent pas';
        }
    }
?>