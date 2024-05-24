<?php 

    include ("include/config.inc.php");
    $bMauvaisMot=false;

    // si je POSTE le champ, c'est que j'essaie de me connecter
    if (isset($_POST["login"]))
    {

        $sql="select Password from `user` where mail = ".QuoteStr($_POST["login"]);
        $hash=GetSQLValue($sql);
                
        // la variable $hash correspond au sha256 du password

        if (isset($hash))
        {
            $password_poste= $_POST["mdp"];
            $hash_poste=hash('sha256', $_POST["mdp"]);
            //$hash_poste= $_POST["mdp"];
            // si le hash que je poste est égale à celui qui est dans la bdd, c'est que le couple Login/password est correct
            
            if($hash==$hash_poste)
                {
                    $_SESSION['isConnected'] = true;
                    $_SESSION['login']=$_POST["login"];
                    header("location: liste.php"); 
                }
            else
                {
                    $bMauvaisMot=true;
                }

        }
        else
            { 
                $bMauvaisMot=true;
            }
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

    <main>
        
        <form method="POST">

            <div class="center-element">
            <h1 class="tireh1">Bienvenue à la pixel war 2024 </h1>
            <img src="img/logo-polytech-dijon.png">
            <div>
            <input type="login" name = 'login' id="floatingInput" placeholder="login interne" required>
            <label for="floatingInput">Login</label>
            </div>
            <div>
            <input type="password" name = "mdp" id="floatingPassword" placeholder="Mot de passe" required>
            <label for="floatingPassword">Password</label>
            </div>

            <input  type="submit" class="button-link" value="Se connecter">

            <input  type="button" class="button-link" value="S'inscrire" onclick="location.href='formulaire.php'" >
            <p>&copy; 2024 Cyber IOT PolyTech</p>

            <?php if ($bMauvaisMot)
            { ?>
            <div class="alert-warning">
                <strong>Attention!</strong> Vous avez saisi un couple login/mot de pass.
                </div>
            <?php } ?>
            </div>
            
        </form>
    </main>

</body>
</html>