<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon site de recettes</title>

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
    <?php include('header.php'); ?>
    
    <!-- Le corps -->
    <div class="container my-4 content">
        <h1>Mon site de recettes</h1>
        <?php 
        include('functions.php');
        include('error.php');
        ?>
        <p>Bienvenue sur mon site de recettes !</p>
    </div>

    <?php include('footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
</html>
