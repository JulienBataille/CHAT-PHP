<?php

session_start();
if(!isset($_SESSION['user'])){
    header('location: index.php');
}

$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$user ?> | chat</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="chat">
        <div class="button_email">
            <span><?=$user ?></span>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        <!-- messages --> 
        <div class="message_box">Chargement ...</div>
        <!-- Fin messages --> 

        <?php
        //envoi de messages
        if(isset($_POST['send']))
        {
            $message = $_POST['message'];
            include('connexion_bdd.php');
            if (isset($message) && $message !="")
            {
                $req = mysqli_query($con, "INSERT INTO messages (email, msg, date) VALUES('$user', '$message', NOW())");
                header('location: chat.php');
            } else {
                header('location: chat.php');
            }


        }
        ?>

        <form action="" class="send_message" method="POST">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>
            <input type="submit" value="Envoyé" name="send">
        </form>
    </div>
    
    <script>
        // actualisation automatique du chat AJAX
        var message_box = document.querySelector('.message_box');
        setInterval(function()
        {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    message_box.innerHTML = this.responseText;
                }

            };
            xhttp.open("GET", "messages.php", true);
            xhttp.send();

        }, 500)


    </script>


</body>
</html>