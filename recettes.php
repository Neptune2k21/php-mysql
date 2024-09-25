<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <title>Créer une Recette</title>
</head>
<body>

<!-- Inclusion de la barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Mon Site de Recettes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="recettes.php">Recettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="create_recipe.php">Ajouter Recette</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Créer une nouvelle recette</h2>
    <form action="submit_recipe.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Titre de la recette</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="recipe" class="form-label">Recette</label>
            <textarea class="form-control" id="recipe" name="recipe" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="is_enabled" class="form-label">Rendre la recette publique ?</label>
            <select class="form-select" id="is_enabled" name="is_enabled" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer la recette</button>
    </form>
</div>

</body>
</html>
