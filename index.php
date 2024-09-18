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
        if(isset($_POST['button_con']))
        {
            include 'connexion_bdd.php';
            //extraire les infos du formulaire
            extract($_POST);
            if(isset($email) && isset($mdp1) && $email !="" && $mdp1 !="")
            {
                //verifier si l'utilisateur existe
                $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email='$email' AND mdp='$mdp1'");
                if(mysqli_num_rows($req) > 0)
                {
                    // création d'une session qui contient l'email
                    $_SESSION['user'] =$email;
                    //redirection vers la page chat
                    header("location: chat.php");
                    unset($_SESSION['message']);

                } else {
                    $error = "Email ou mot de passe incorrect";
                }


            }else{
                $error = "Veuillez remplir tous les champs";

            }

        }
    ?>
    <form action="" class="form_connexion_inscirption" method="POST">
        <h1>Connexion</h1>
        <?php
            //afiche le message de valdiation de compte
            if(isset($_SESSION['message']))
            {
                echo $_SESSION['message'];

            }

        ?>
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
        <input type="password" name="mdp1">
        <input type="submit" value="Connexion" name="button_con">
        <p class="link">Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>
    </form>
    
    <script src="script.js"></script>
</body>
</html>