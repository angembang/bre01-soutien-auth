<?php

// j'appelle la connexion à ma base de données
require "../config/database.php";

// je récupère les informations du formulaire
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $signupUsername = $_POST["signupUsername"];
    $signupEmail = $_POST["signupEmail"];
    $signupPassword = $_POST["signupPassword"];
    $signupConfirmPassword = $_POST["signupConfirmPassword"];
    $signupRole = $_POST["signupRole"];
    
    // je chiffre son mot de passe
    $hashPassword = password_hash($signupPassword, PASSWORD_DEFAULT);

    // je stocke mon utilisateur avec son mot de passe chiffré dans la base de données
    $request = $db->prepare("INSERT INTO users (username, email, password, role, created_at) 
    VALUES (:username, :email, :password, :role, NOW())");
    $parameters = [
        "username"=>$signupUsername,
        "email"=>$signupEmail,
        "password"=>$hashPassword,
        "role"=>$signupRole
      ];
      $signupUser = $request->execute($parameters);

      
      // je modifie ma session pour dire que j'ai un utilisateur connecté et son rôle
      if($signupUser)
      {
          session_start();
          $_SESSION["user_id"] = $db->lastInsertId();
          $_SESSION["user_role"] = $signupRole;
      }
      
      // s'il a le role user je redirige vers le profil
      if($signupRole === "user")
      {
          header("Location: ../templates/profile.phtml");
      }

}else
{
    echo "echec lors de l'inscription";
}







