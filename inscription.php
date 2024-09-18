<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion |Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
        if(isset($_POST['button_inscription']))
        {
            include "connexion_bdd.php";
            extract($_POST);
            if(isset($email) && isset($mdp1) && isset($mdp2) && $email !="" && $mdp1 !="" && $mdp2 !="")
            {
                //verification mdp conforme
                if($mdp2 !== $mdp1)
                {
                    $error = "Les mots de passe ne sont pas identiques";
                }else {
                    //verification si l'email existe deja
                    $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email = '$email'");
                    if (mysqli_num_rows($req) == 0)
                    {
                        //insertion dans la bdd
                        $req = mysqli_query($con, "INSERT INTO utilisateurs (email, mdp) VALUES ('$email', '$mdp1')");
                        if($req)
                        {
                            $_SESSION['message'] = "<p class= 'message_inscription'>Votre compte a été créé avec succès</p>";
                            header("Location: index.php");
                        }else {
                            $error = "Inscription Echouée";
                        }
  
                    }else {
                        $error = "Cette adresse mail est déjà utilisée";
                    }

                }

            }else {
                $error = "Veuillez remplir tous les champs";
            }
        }

    ?>
    <form action="" class="form_connexion_inscirption" method="POST">
        <h1>Inscription</h1>
        <p class="message_error">
            <?php 
                //affiche l'erreur
                if(isset($error))
                {
                    echo $error;
                }

            ?>
        </p>
        <label>Adresse Mail</label>
        <input type="email" name="email">
        <label>Mot de passe</label>
        <input type="password" name="mdp1" class="mdp1">
        <label>Confirmation Mot de passe</label>
        <input type="password" name="mdp2" class="mdp2">
        <input type="submit" value="Inscritpion" name="button_inscription">
        <p class="link">Vous avez un compte ? <a href="index.php">Se connecter</a></p>
    </form>


    <script src="script.js"></script>
    
</body>
</html>