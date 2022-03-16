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
                    <label for="email" id="labelMail" class="d-block text-white">Email</label>
                    <input type="email" name="email" id="inputMailConnexion" class="rounded" required>
                </div>

                <div class="mt-4 mb-5">
                    <label for="password"  id="labelPassword" class="d-block text-white">Mot de passe</label>
                    <input type="password" name="password" id="inputPasswordConnexion" class="rounded" required>
                </div>

                <button type="submit" name="btn-connexion" class="btn-de-connexion rounded border p-2 mb-1">CONNEXION</button>

                <div>
                    <a href="mdp_oublie.php" class="MDPoublie">mot de passe oublié</a>
                </div>


            </form>

        </div>

    </div>
</div>



<!-----------------------------------CONDITIONS DE LA FONCTION CONNEXION------------------------------------>
    <?php
        function connexion(){
                //-------------CONNEXION A LA BD----------------
                $user = "root";
                $pass = "";

                try{

                    //instance de la classe PDO (PHP DATA OBJECT!)
                    $dbh = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", $user, $pass);

                    //debug ATTR_ERRMODE : rapport d'erreurs.  ERRMODE_EXCEPTION : émet une exception.
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    ?>
                    <div>
                        <p class="connexionPDOMYSQL text-center text-warning">Connexion à PDO MySQL réussie</p>
                    </div>
                    <?php
                }catch(PDOException $a){
                    ?>
                    <div>
                        <p class="text-center text-warning">Erreur! <?= $a->getMessage() ?></p>
                    </div>
                    <?php
                    die();
                }


            //Existence des champs et non vide
            if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){

               ;
                //faille xss = ON DESINFECTE LES DONNÉES = Sanitize
                //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
                //htmlspecialchars — Convertit les caractères spéciaux en entités HTML :: Cette fonction retourne une chaîne de caractères avec ces modifications
                $emailUtilisateur = trim(htmlspecialchars($_POST['email']));
                $passwordUtilisateur = trim(htmlspecialchars($_POST['password']));

                //Debug
                var_dump($emailUtilisateur);
                var_dump($passwordUtilisateur);

                //Requete avec le prediquats AND = &&
                $sql = "SELECT * FROM `users_admins` WHERE `email_userAdmin` = ? AND `password_userAdmin` = ?";

                //requète préparée pour lutter contre les inection SQL
                $connexion = $dbh->prepare($sql);

                //Lie les paramètre du formulaire a  la requète SQL
                $connexion->bindParam(1, $emailUtilisateur);
                $connexion->bindParam(2, $passwordUtilisateur);

                //Execute la requète et retourne un tableau associatif
                $connexion->execute();

                //Si on a au moins 1 utilisateur dans table (index du tableau commence par 0)
                if($connexion->rowCount() >= 0){
                    //On stock dans une variable le dernier resultat
                    //PDOStatement::fetch — Récupère la ligne suivante d'un jeu de résultats PDO
                    $ligne = $connexion->fetchAll();
                    //Si on a un resultat = return true
                    if($ligne){
                        //On recup les email et password de la table utilisateurs
                        $email = $ligne['email'];
                        $password = $ligne['password'];

                        //Condition de connexion
                        //Si entrée utilisateur = valeurs dans la table pour email et mot de passe
                        if($emailUtilisateur == $email && $passwordUtilisateur == $password){
                            //On stock la connexion dans une variable de session et on redirige ves la page d'accueil
                            $_SESSION['email'] = $emailUtilisateur;
                            header("Location: pages/produits.php");
                        }else{
                            //Erreur de mail et mot de passe
                            echo "<div class='mt-3 container'>
                    <p class='alert alert-danger p-3'>Erreur de connexion: merci de verifié votre email et mot de passe</p>
                    </div>";
                        }
                    }else{
                        //pas d'utilisateur dans la table
                        echo "<div class='mt-3 container'>
                    <p class='alert alert-danger p-3'>Erreur de connexion: Aucun utilisateur dans votre table</p>
                    </div>";
                    }

                }else{
                    //Idem
                    echo "Votre table est vide";
                }


            }else{
                //Certains champs sont vide
                echo "Merci de remplir tous les champs";
            }

        }

    //Le clic sur le bouton on appel la fonction de  connexion
    if(isset($_POST['btn-connexion'])){
        connexion();
    }
    ?>


<!-----------------------------------FONCTION CONNEXION DU BOUTON APPELEE------------------------------------>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>