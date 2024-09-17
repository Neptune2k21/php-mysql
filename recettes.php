<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recettes</title>
    
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }
    </style>
</head>
<body>
    <!-- L'en-tête -->
    <?php include('header.php');
          include('functions.php');
          include('AfficherRecettes.php')
    ?>
    
    <!-- Le corps -->
    <div class="container my-4 content">
        <h1>Liste des recettes</h1>
        <!-- Plus facile à lire -->
        <?php foreach(get_recipes($recipes) as $recipe) : ?>
            <article class="mb-4">
                <h3><?php echo htmlspecialchars($recipe['title']); ?></h3>
                <div><?php echo nl2br(htmlspecialchars($recipe['recipe'])); ?></div>
                <i><?php echo display_author($recipe['author'], $users); ?></i>
            </article>
        <?php endforeach ?>
    </div>

    <!-- Le pied de page -->
    <?php include('footer.php'); ?>
    
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
