<?php
session_start();
require_once('functions.php');

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: login.php');
    exit;
}

// Vérifiez que l'identifiant de la recette est fourni
if (isset($_POST['recipe_id'])) {
    $recipe_id = intval($_POST['recipe_id']);

    // Connexion à la base de données
    try {
        $db = new PDO('mysql:host=localhost;dbname=my_recipes;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    // Vérifier que la recette existe et appartient à l'utilisateur
    $sqlQuery = 'SELECT author FROM recipes WHERE recipe_id = :recipe_id';
    $statement = $db->prepare($sqlQuery);
    $statement->execute(['recipe_id' => $recipe_id]);
    $recipe = $statement->fetch(PDO::FETCH_ASSOC);

    if ($recipe && $recipe['author'] === $_SESSION['LOGGED_USER']['email']) {
        // Supprimer la recette
        $sqlDelete = 'DELETE FROM recipes WHERE recipe_id = :recipe_id';
        $deleteStatement = $db->prepare($sqlDelete);
        $deleteStatement->execute(['recipe_id' => $recipe_id]);

        $_SESSION['SUCCESS_MESSAGE'] = 'Recette supprimée avec succès.';
    } else {
        $_SESSION['ERROR_MESSAGE'] = 'Accès non autorisé ou recette introuvable.';
    }
} else {
    $_SESSION['ERROR_MESSAGE'] = 'Aucun identifiant de recette fourni.';
}

header('Location: index.php'); // Rediriger vers la page d'accueil après la suppression
exit;
