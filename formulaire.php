<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection vers Formulaire</title>
    <link href="style.css" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>

<form action="config.php" method="POST">
<div class="center-element">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br> 
    <label for="Password">Mot de passe:</label>
    <input type="password" id="Password" name="Password" required><br><br>
    <label for="pseudo">Speudo:</label>
    <input type="pseudo" id="pseudo" name="pseudo" required><br><br>
    <input type="submit"class="button-link" value="Ajouter l'utilisateur">
    <p>&copy; 2024–Cyber IOT PolyTech</p>
</div>
</form>

</body>
</html>


