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
        // je ne fais rien
    }
    // Verifier s'il a le role d'admin
    else if($_SESSION["user_role"] === "admin")
    {
        header("Location: ../templates/admin.phtml");
    }
}


