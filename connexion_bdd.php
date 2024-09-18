<?php
    //connexion à la base de données
    $con = mysqli_connect("localhost","root","","chat_youtube");

    //gérer les accents et autres caractères français
    $req = mysqli_query($con, "SET NAMES UTF8");

    if(!$con)
    {
        echo "Erreur de connexion à la base de données";
    }
