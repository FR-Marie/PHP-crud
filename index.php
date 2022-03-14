<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- JavaScript Bundle with Popper -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">

    <!------------google font-------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    

    
    <title>Connexion</title>

    

</head>


<body>
    
<div class="container-fluid">
    <div class="row text-center">

    <h2 id="h2-connexion" class="text-center text-white mt-5">Connectez-vous pour accéder au site</h2>

        <div class="form-connexion w-50 m-auto mt-5">

            <form action="" method="POST">

                <div class="mt-5 mb-2">
                    <label for="email" name="email" id="labelMail" class="d-block text-white">Email</label>
                    <input type="email" name="email" id="inputMailConnexion" class="rounded" value="" required>
                </div>

                <div class="mt-4 mb-5">
                    <label for="password" name="password" id="labelPassword" class="d-block text-white">Mot de passe</label>
                    <input type="password" name="password" id="inputPasswordConnexion" class="rounded" value="" required>
                </div>

                <button type="submit" name="btn-connexion" class="btn-de-connexion rounded border p-1 mb-5">Connexion</button>

            </form>

            <?php

            if(isset($_POST["btn-connexion"])){
                //echo "btn connexion ok";
                connexion();
            }
                function connexion(){

                    $userEmail = trim(htmlspecialchars($_POST["email"]));
                    $userPassword = trim(htmlspecialchars($_POST["password"]));

                    if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])){
                        $email = "marieprojet3@email.com";
                        $password = "mdp";

                        if($userEmail == $email && $userPassword == $password){
                            $_SESSION["email"] = $userEmail;
                            header("location: accueil.php");
                        }else{
                            ?>
                            <div class="alertConnexion">Erreur, veuillez vérifier vos ids</div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="alertConnexion">Erreur, merci de remplir tous les champs</div>
                        <?php
                    }
                }          

            ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>