<?php
session_start();

if(isset($_SESSION["email"])){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">

    <!-----------------font awesome---------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!------------google font-------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    
    <title>Ajout admins</title>

    

</head>


<body>


<!--------------------NAV BAR----------------------->
<div class="container-fluid w-100">
    <div class="row">
        <?php
        require_once "navbar.php";
        ?>
    </div>
</div>

<!-------------------------------CONNEXION A LA BD----------------------->
<div class="container-fluid">
    <div class="row">
        

<?php
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
?>



<!---------------------------FORMULAIRE D'INSCRIPTION--------------------------->

    <div class="container text-center text-white mt-5">
        <div class="row">

            
        <form action="" method="POST" id="addAdmins">

            <h2 class="text-warning">Ajouter un admin</h2>

                <div class="mb-3 mt-5">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" name="email" class="rounded" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="password" name="password" class="rounded" required>
                </div>

                <div class="mb-3">
                    <label for="password_repeat" class="col-form-label">Verify passord</label>
                    <input type="password" name="password_repeat" class="rounded" required>
                </div>
                
                </div class="mb-5">
                    <input type="checkbox" name="captcha" class="rounded" required>
                    <label for="captcha" class="col-form-label">I'm not a robot</label>
                <div>

            
                <div class="mt-3">
                    <button type="submit" class="btn btn-success border border-warning text-warning">VALIDER</button>
                    <a href="accueil.php" id="btn-annuler-delete-produit" class="btn btn-danger border border-warning text-warning ms-2">ANNULER</a>
                </div>

            </form>


            
            

      

<!---------------------------TRAITEMENT DU FORMULAIRE D'INSCRIPTION--------------------------->
<?php


//////// SI LES CHAMPS SONT REMPLIS =>
if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["captcha"])){

    $emailAdmin = trim(htmlspecialchars($_POST["email"]));
    $passwordAdmin = trim(htmlspecialchars($_POST["password"]));
    $passwordAdmin_repeat = trim(htmlspecialchars($_POST["password_repeat"]));

///////SI LE MDP EST VERIFIE ET VALIDE =>
    if($passwordAdmin === $passwordAdmin_repeat){
        $sql = "INSERT INTO `users_admins`( `email_userAdmin`, `password_userAdmin`) VALUES (?,?)";
        
        //Prépare la requeête SQL pour ajouter l'admin
        $add_admins = $dbh->prepare($sql);

        //Lie les paramètres du formulaire (!!attention aux valeurs!!)
        $add_admins->bindParam(1, $emailAdmin);
        $add_admins->bindParam(2, $passwordAdmin);

        //Execute la requête
        $add_admins->execute( [
            $emailAdmin,
            $passwordAdmin
        ]);
    }

    //SI LA REQUETE EST EXECUTEE =>
    if($add_admins){
        ?>
        <div>
            <p class="alert alert-success w-50 m-auto mt-5">Ajout d'admin avec succès</p>
            <a href="index.php" class="btn btn-primary text-white border border-success mt-3">SE CONNECTER</a>

            <style>
                #addAdmins{
                    display: none;
                }
            </style>
        </div>
        <?php
    //SI ECHEC LORS DE L'EXECUTION DE LA REQUETE =>
    }else{
        ?>
        <div>
            <p class="alert alert-danger w-50 m-auto">Echec de l'ajout d'admin</p>
        </div>
        <?php
    }
}
?>

        </div>
    </div>



<!---------------------SESSION FAILED------------------->

<?php
}else{
    header("location: index.php");
}
?>

</body>
</html>