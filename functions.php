<?php
function getUserByEmail($email, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user['name'];
        }
    }
    return 'Auteur inconnu'; 
}

function displayRecipes($recipes, $users) {
    echo '<ul>';
    foreach ($recipes as $recipe) {
        if ($recipe['enable']) {
            $authorName = getUserByEmail($recipe['author'], $users);
            echo '<li>';
            echo '<h2>' . htmlspecialchars($recipe['title']) . '</h2>';
            echo '<p>' . htmlspecialchars($recipe['recipe']) . '</p>';
            echo '<p class="author">Contributeur : <span class="user">' . htmlspecialchars($authorName) . '</span></p>';
            echo '</li>';
        }
    }
    echo '</ul>';
}
?>
