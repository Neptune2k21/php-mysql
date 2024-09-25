<?php
session_start();
require_once(__DIR__ . '/error.php');
require_once(__DIR__ . '/functions.php');
require_once('mysql.php'); // Connexion à la base de données

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: login.php'); // Redirige vers la page de connexion si non connecté
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- inclusion de l'entête du site -->
        <?php require_once(__DIR__ . '/header.php'); ?>
        
        
        <h1>Site de recettes</h1>
         <!-- Formulaire de connexion -->
         <?php require_once(__DIR__ . '/login.php'); ?>
        <!-- Afficher les recettes -->
        <?php foreach (get_recipes($recipes) as $recipe) : ?>
            <article class="mb-4">
                <h3><?php echo htmlspecialchars($recipe['title']); ?></h3>
                <div><?php echo nl2br(htmlspecialchars($recipe['recipe'])); ?></div>
                <i><?php echo display_author($recipe['author'], $users); ?></i>
                
                <div class="mt-2">
                    <a href="edit.php?recipe_id=<?php echo $recipe['recipe_id']; ?>" class="btn btn-warning">Modifier</a>
                    <form action="delete_recipe.php" method="POST" style="display:inline;">
                        <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">Supprimer</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <!-- inclusion du bas de page du site -->
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>
