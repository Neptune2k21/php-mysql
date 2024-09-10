<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Message bien reçu !</title>
        <!-- Lien vers Bootstrap pour styliser la page -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
 
    <body>

    <!-- L'en-tête -->
    <?php include('header.php'); ?>
    
    <!-- Le corps -->
    <div class="container my-4">

        <?php
        // Vérification des paramètres POST
        if (!isset($_POST['email']) || !isset($_POST['message'])) {
            echo('<h1>Il faut un email et un message pour soumettre le formulaire.</h1>');
            // Arrête l'exécution de PHP
            return;
        }

        // Validation de l'email et du message
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['message'])) {
            echo('<h1>Il faut un email et un message valides pour soumettre le formulaire.</h1>');
            return;
        }
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
        ?>

        <h1>Message bien reçu !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo htmlspecialchars($_POST['email']); ?> </p>
                <p class="card-text"><b>Message</b> : <?php echo htmlspecialchars(nl2br($_POST['message'])); ?> </p>
            </div>
        </div>
    </div>
    
    <!-- Le pied de page -->
    <?php include('footer.php'); ?>
    
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
</html>
