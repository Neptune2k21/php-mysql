<?php

session_start(); // Démarrer la session pour stocker les informations de l'utilisateur

// Inclure la connexion à la base de données et les fonctions nécessaires
require_once(__DIR__ . '/mysql.php');
require_once(__DIR__ . '/functions.php');

// Validation du formulaire
$postData = $_POST;

if (isset($postData['email']) && isset($postData['password'])) {
    // Vérifier que l'email est valide
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Il faut un email valide pour soumettre le formulaire.';
        redirectToUrl('login.php');
        exit;
    }

    // Préparer la requête pour récupérer l'utilisateur en fonction de l'email
    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindParam(':email', $postData['email']);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($postData['password'], $user['password'])) {
        // Stocker l'utilisateur dans la session après une connexion réussie
        $_SESSION['LOGGED_USER'] = [
            'email' => $user['email'],
            'user_id' => $user['user_id'],
            'full_name' => $user['full_name'] 
        ];        
        // Redirection vers la page d'accueil après connexion
        redirectToUrl('index.php');
        exit;
    } else {
        // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Les informations envoyées ne permettent pas de vous identifier.';
        redirectToUrl('login.php');
        exit;
    }
} else {
    // Si les données du formulaire sont manquantes
    $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Veuillez remplir tous les champs.';
    redirectToUrl('login.php');
    exit;
}
?>
