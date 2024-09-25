<h2>Modifier la recette : <?php echo htmlspecialchars($recipe['title']); ?></h2>
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
<?php
session_start();
require_once('functions.php');

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    header('Location: login.php');
    exit;
}

// Vérifie que les données sont soumises
if (isset($_POST['recipe_id'], $_POST['title'], $_POST['recipe'], $_POST['is_enabled'])) {
    $recipe_id = intval($_POST['recipe_id']);
    $title = trim($_POST['title']);
    $recipe = trim($_POST['recipe']);
    $is_enabled = intval($_POST['is_enabled']);

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
    $recipeData = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$recipeData || $recipeData['author'] !== $_SESSION['LOGGED_USER']['email']) {
        die("Accès non autorisé ou recette introuvable.");
    }

    // Mettre à jour la recette
    $sqlUpdate = 'UPDATE recipes SET title = :title, recipe = :recipe, is_enabled = :is_enabled WHERE recipe_id = :recipe_id';
    $updateStatement = $db->prepare($sqlUpdate);
    
    try {
        $updateStatement->execute([
            'title' => $title,
            'recipe' => $recipe,
            'is_enabled' => $is_enabled,
            'recipe_id' => $recipe_id,
        ]);
        $_SESSION['SUCCESS_MESSAGE'] = 'Recette mise à jour avec succès.';
        header('Location: index.php'); // Rediriger après mise à jour
        exit;
    } catch (Exception $e) {
        die('Erreur lors de la mise à jour : ' . $e->getMessage());
    }
} else {
    die("Données manquantes.");
}
?>
