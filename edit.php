<?php
session_start();
require_once('functions.php');

if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['recipe_id'])) {
    die("Aucun identifiant de recette fourni.");
}

$recipe_id = intval($_GET['recipe_id']);


try {
    $db = new PDO('mysql:host=localhost;dbname=my_recipes;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT * FROM recipes WHERE recipe_id = :recipe_id';
$statement = $db->prepare($sqlQuery);
$statement->execute(['recipe_id' => $recipe_id]);
$recipe = $statement->fetch(PDO::FETCH_ASSOC);

// Vérifiez si la recette existe et si l'utilisateur est le propriétaire
if (!$recipe || (isset($_SESSION['LOGGED_USER']['email']) && $recipe['author'] !== $_SESSION['LOGGED_USER']['email'])) {
    die("Accès non autorisé ou recette introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier la recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <!-- Inclusion de l'entête du site -->
        <?php require_once(__DIR__ . '/header.php'); ?>

        <h2 class="mt-4">Modifier la recette : <?php echo htmlspecialchars($recipe['title']); ?></h2>
        <form action="submit_edit_recipe.php" method="POST">
            <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Recette</label>
                <textarea class="form-control" id="recipe" name="recipe" rows="5" required><?php echo htmlspecialchars($recipe['recipe']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="is_enabled" class="form-label">Rendre la recette publique ?</label>
                <select class="form-select" id="is_enabled" name="is_enabled" required>
                    <option value="1" <?php echo $recipe['is_enabled'] ? 'selected' : ''; ?>>Oui</option>
                    <option value="0" <?php echo !$recipe['is_enabled'] ? 'selected' : ''; ?>>Non</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour la recette</button>
        </form>
    </div>


    <?php require_once(__DIR__ . '/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
