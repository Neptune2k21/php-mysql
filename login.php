<?php
// Vérifie si une session est déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Si l'utilisateur n'est pas identifié(e), on affiche le formulaire -->
<?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
    <form action="submit_login.php" method="POST">
        <!-- Si un message d'erreur existe, on l'affiche -->
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE']; ?>
                <?php unset($_SESSION['LOGIN_ERROR_MESSAGE']); // On supprime le message après affichage ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com" required>
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

<!-- Si l'utilisateur est bien connecté(e), on affiche un message de succès -->
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo htmlspecialchars($_SESSION['LOGGED_USER']['full_name']); ?> et bienvenue sur le site !
    </div>
<?php endif; ?>
