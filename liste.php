<?php
session_start();
if (!isset($_SESSION['isConnected']) || $_SESSION['isConnected'] !== true) 
    {
        header("location: index.php");
        exit();
    }

$newGame = isset($_POST['new_game']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_game'])) {
    // Connexion à la base de données
    $host='localhost';
    $user = "esirem";
    $password = "esirem21";
    $base = "pixel_war";

    try {
        // Créer une connexion
        $connexion = new mysqli($host, $user,$password,$base);

        // Vérifier la connexion
        if ($connexion->connect_error)
        {
            die("La connexion a échoué: " . $connexion->connect_error);
        }
        $name = $_POST['name'];
        
        // Créer une grille 30x30 remplie de zéros
        $grid = array_fill(0, 30, array_fill(0, 30, 0));
        $grid_json = json_encode($grid);

        // Insérer la grille dans la table "grille"
        $requet = $connexion->prepare("INSERT INTO sheet (name) VALUES (?)");
        $requet->bind_param("s", $name);
        $requet->execute();

        // Insérer les pixels dans la table "pixel"
        //$requet = $connexion->prepare("INSERT INTO pixel (id, color, x, y) VALUES (?, ?, ?, ?)");
        //foreach ($grid as $r => $row) {
        //   foreach ($row as $c => $value) {
        //        $requet->bind_param("ssss", $id, $color, $x, $y);
        //        $requet->execute();
        //    }
        //}

    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion
    $requet->close();
    $connexion->close();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIXEL WAR POLYTECH</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <form method="post">
        <label class="button-link" for="name">Nom de la grille :</label>
        <input type="text" class="button-link" id="name" name="name" required>
        <button type="submit" class="button-link" name="new_game">Nouvelle Partie</button>
        <br>
        <input type="button" class="button-link" value="Charger partie" onclick="location.href='liste.php'">
    </form>

    <div class="grid" id="pixelGrid">
           
        <?php if ($newGame): ?>
            <div class="grid" id="pixelGrid">
        <?php
            for ($i = 0; $i < 30 * 30; $i++) 
            {
                echo '<div class="pixel"></div>';
            }
        ?>
    </div>
        <?php endif; ?>
    </div>

    <input type="color" id="colorPicker" style="display: none;">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pixels = document.querySelectorAll('.pixel');
            const grid = document.getElementById('pixelGrid');
            let isBlocked = false;

            pixels.forEach(pixel => {
                pixel.addEventListener('click', function() {
                    if (isBlocked) return;

                    const color = prompt('Insert a color (name or code hexadécimal ex: #0056b3) :');
                    if (color) {
                        pixel.style.backgroundColor = color;
                        isBlocked = true;
                        grid.classList.add('blocked');
                        setTimeout(function() {
                            isBlocked = false;
                            grid.classList.remove('blocked');
                        }, 15000); // 15 secondes
                    }
                });
            });
        });
    </script>

    <input type="button" class="button-link" value="Se déconnecter" onclick="location.href='deconnexion.php'">
    
   
</body>
</html>