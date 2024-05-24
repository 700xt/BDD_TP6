<?php
session_start();
$host='localhost';
$user = "esirem";
$password = "esirem21";
$base = "pixel_war";

// Créer une connexion
$connexion = new mysqli($host, $user,$password,$base);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué: " . $connexion->connect_error);
}

// Récupérer les données du formulaire
$email = $_POST['email'];
$Password = hash('sha256', $_POST['Password']); // Hachage du mot de passe en SHA-256
$pseudo = $_POST['pseudo'];
echo $Password;

// Préparer et lier
$requet = $connexion->prepare("INSERT INTO user (mail, Password, pseudo) VALUES (?, ?, ?)");
$requet->bind_param("sss", $email, $Password, $pseudo);

if ($requet->execute()) {
    $_SESSION['isConnected'] = true;
    $_SESSION['utilisateurAjoute'] = true;
    // Rediriger vers index.php après le succès
    header("Location: index.php");
    exit();
} else {
    echo "Erreur: " . $requet->error;
}

// Fermer la connexion
$requet->close();
$connexion->close();
?>