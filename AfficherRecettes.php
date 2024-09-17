<?php

$users = [
    [
        'email' => 'Aboubacar@example.com',
        'name' => 'Aboubacar Diallo'
    ],
    [
        'email' => 'matthieu-xml@exemple.com',
        'name' => 'Matthieu Dupont'
    ],
    [
        'email' => 'Rachid@example.com',
        'name' => 'Rachid El Amrani'
    ]
];


$recipes = [
    [
        'title' => 'Mafe',
        'recipe' => 'Etape 1 : des legumes, ...',
        'author' => 'Aboubacar@example.com',
        'enable' => true
    ],
    [
        'title' => 'Cassoulet',
        'recipe' => 'Etape 1 : des flageolets, ...',
        'author' => 'matthieu-xml@exemple.com',
        'enable' => false
    ],
    [
        'title' => 'Couscous',
        'recipe' => 'Etape 1 : du Couscous, ...',
        'author' => 'Rachid@example.com',
        'enable' => true
    ]
];




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des recettes et utilisateurs</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            font-size: 1.8em;
            color: #444;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        ul {
            padding: 0;
        }
        li {
            margin-bottom: 15px;
            padding: 15px;
            border-left: 4px solid #444;
            background-color: #fff;
            transition: background-color 0.3s ease;
        }
        li:hover {
            background-color: #f0f0f0;
        }
        li h2 {
            margin: 0 0 8px 0;
            font-size: 1.4em;
            color: #222;
        }
        li p {
            margin: 0;
            font-size: 1em;
            color: #555;
        }
        .author {
            font-style: italic;
            font-size: 0.9em;
            color: #777;
            margin-top: 8px;
        }
        .user {
            color: #444;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Liste des recettes avec auteurs</h1>
<?php

displayRecipes($recipes, $users);
?>

</body>
</html>