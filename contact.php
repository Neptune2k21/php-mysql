<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contactez-nous</title>
        <!-- Lien vers Bootstrap pour styliser la page -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
 
    <body>

  
    <?php include('header.php'); ?>
    
   
    <div class="container my-4">
        <h1>Contactez-nous</h1>
        <form action="submit_contact.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Votre message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <!-- Ajout champ d'upload ! -->
            <div class="mb-3">
                <label for="screenshot" class="form-label">Votre capture d'écran</label>
                <input type="file" class="form-control" id="screenshot" name="screenshot" />
            </div>
            <!-- Fin ajout du champ -->
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('footer.php'); ?>
    
    </body>
</html>
