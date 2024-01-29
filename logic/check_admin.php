<?php

session_start();

// Vérifier si mon utilisateur n'est pas connecté 
if(!isset($_SESSION["user_id"]))
{
   header("Location: ../templates/home.phtml");
   exit ();
} else
{
    // mon utilisateur est connecté
    // Vérifier s'il a le role de user
    if($_SESSION["user_role"] === "user")
    {
        header("Location: ../templates/profile.phtml");
    }
    // Verifier s'il a le role d'admin
    else if($_SESSION["user_role"] === "admin")
    {
       // je ne fais rien
    }
}

