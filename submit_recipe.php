<?php
session_start();
require_once(__DIR__ . '/mysql.php'); // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    // Redirige vers la page de connexion si non connecté
    header('Location: login.php');
    exit;
}

// Récupération des données du formulaire
$postData = $_POST;

if (isset($postData['title'], $postData['recipe'], $postData['is_enabled'])) {
    $title = trim($postData['title']);
    $recipe = trim($postData['recipe']);
    $is_enabled = $postData['is_enabled'] == '1' ? 1 : 0;
    $author = $_SESSION['LOGGED_USER']['email']; // Utilise l'email de l'utilisateur connecté comme auteur

    // Vérification basique des données
    if (empty($title) || empty($recipe)) {
        $_SESSION['RECIPE_ERROR_MESSAGE'] = 'Tous les champs doivent être remplis.';
        header('Location: create_recipe.php');
        exit;
    }

    // Insertion dans la base de données
    try {
        $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled)
                     VALUES (:title, :recipe, :author, :is_enabled)';
        $insertRecipe = $db->prepare($sqlQuery);
        $insertRecipe->execute([
            'title' => $title,
            'recipe' => $recipe,
            'author' => $author,
            'is_enabled' => $is_enabled
        ]) or die(print_r($db->errorInfo()));

        // Redirection après succès
        $_SESSION['SUCCESS_MESSAGE'] = 'Recette créée avec succès !';
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
} else {
    $_SESSION['RECIPE_ERROR_MESSAGE'] = 'Tous les champs sont obligatoires.';
    header('Location: create_recipe.php');
    exit;
}
