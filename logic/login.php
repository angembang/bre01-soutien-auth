<?php
// j'appelle la connexion à ma base de données
require "../config/database.php";

// Ici je vais enter de connecter mon utilisateur
// Vérifier si le formulaire est soumis avec la méthode post
if($_SERVER["REQUEST_METHOD"]=== "POST")
{
   // Récupérer l'email et le password envoyés par le formulaire 
   $loginEmail = $_POST["loginEmail"];
   $loginPassword = $_POST["loginPassword"];
   
   /******* Vérifier dans la base de données si un utilisateur existe avec cet email*****/
   // Préparer la requête
   $request = $db->prepare("SELECT * FROM users Where email = :email");
   // les paramètres
   $parameters = [
       "email" => $loginEmail
       ];
    // Exécuter la requête   
    $request->execute($parameters);
    // Récupérer l'utilisateur et le stocker dans user
    $user = $request->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si l'utilisateur existe
    if(!$user)
    {
      // si oui, rédiriger vers la page index.php
      header("Location : ../home.phtml");
    } else
    {
        // Vérifier le mot de passe
        $dataPassword = $user["password"];
        if(password_verify($loginPassword, $dataPassword))
        {
          // Modifier ma session pour dire que j'ai un utilisateur connecté et son rôle 
          session_start();
          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_role"] = $user["role"];
          
          // S'il a le rôle "user", je redirige vers le profil
          if ($user["role"] === "user")
          {
               header("Location: ../templates/profile.phtml");
          } 
          // S'il a le rôle "admin", je redirige vers l'admin
          else if($user["role"] == "admin")
          {
              header("Location: ../templates/admin.phtml");
          } 
        } else 
          {
              // Le mot de passe n'est pas bon, je redirige vers la page  home
              header("Location: ../templates/home.phtml");
              exit;

          }
    }
}








// s'il n'est pas bon je redirige vers la home

// s'il est bon je modifie ma session pour dire que j'ai un utilisateur connecté et son rôle

// s'il a le role user je redirige vers le profil

// s'il a le role admin je redirige vers l'admin

