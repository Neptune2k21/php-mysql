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
            return;
        }

        // Validation de l'email et du message
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || empty($_POST['message'])) {
            echo('<h1>Il faut un email et un message valides pour soumettre le formulaire.</h1>');
            return;
        }

        // Sécurisation des données avec htmlspecialchars
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

        // Traitement du fichier uploadé
        if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0) {
            if ($_FILES['screenshot']['size'] <= 2000000) { // 2 Mo max
                // Vérifier l'extension du fichier
                $file_info = pathinfo($_FILES['screenshot']['name']);
                $file_extension = strtolower($file_info['extension']);
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

                if (in_array($file_extension, $allowed_extensions)) {
                    $upload_dir = 'uploads/';
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }
                    $file_path = $upload_dir . basename($_FILES['screenshot']['name']);
                    move_uploaded_file($_FILES['screenshot']['tmp_name'], $file_path);

                    echo '<p>Fichier envoyé avec succès : <a href="' . $file_path . '">' . htmlspecialchars($_FILES['screenshot']['name']) . '</a></p>';
                } else {
                    echo '<p>Extension de fichier non autorisée. Veuillez envoyer un fichier au format jpg, jpeg, png, gif ou pdf.</p>';
                }
            } else {
                echo '<p>Le fichier est trop volumineux. Taille maximale : 2 Mo.</p>';
            }
        } else {
            echo '<p>Aucun fichier n\'a été envoyé ou une erreur est survenue.</p>';
        }
        ?>

        <h1>Message bien reçu !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo $email; ?> </p>
                <p class="card-text"><b>Message</b> : <?php echo nl2br($message); ?> </p>
            </div>
        </div>
    </div>
    
    <!-- Le pied de page -->
    <?php include('footer.php'); ?>
    
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
</html>
