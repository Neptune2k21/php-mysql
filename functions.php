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


function display_recipe(array $recipe) : string
{
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }
    
    return $recipe_content;
}

function display_author(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}

function get_recipes(array $recipes) : array
{
    $valid_recipes = [];

    foreach($recipes as $recipe) {
        if (isset($recipe['is_enabled']) && $recipe['is_enabled']) {
            $valid_recipes[] = $recipe;
        }
    }

    return $valid_recipes;
}

function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}


?>
