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

    
    
    <title>Gestion admins</title>

    

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
    </div>
</div>

<!-------------------------------AFFICHAGE DES ADMINS----------------------->
<?php

    $sql = "SELECT * FROM `users_admins`";
    
    $requeteAddAdmin = $dbh->query($sql);

?>

<div class="container">

    <div class="mt-5 w-25 m-auto bg-warning text-center rounded p-3">
        <form action="ajouter_admins" method="POST">
            <button type="submit" name="btn-inscription" class="btn-deconnexion-accueil p-2">AJOUTER ADMINS</button>
        </form>
    </div>

    <table class="table table-striped text-white mt-5 bg-success rounded">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Email</th>
            <th scope="col">Mot de passe</th>
            <th scope="col">EDITER</th>
            <th scope="col">SUPPRIMER</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //On recup notre tableau d'utilisateur et on parcours en bouclant sur un alias
            foreach ($requeteAddAdmin as $admins){
                ?>
                <tr>
                    <!--ici alis['intitulé de la colonne phpMyAdmin table utilisateurs']-->
                    <th scope="row"><?= $admins['id_userAdmin'] ?></th>
                    <td><?= $admins['email_userAdmin'] ?></td>
                    <td><?= $admins['password_userAdmin'] ?></td>
                    <td>
                        <a href="" class="btn btn-primary border border-warning">EDITER</a>
                    </td>
                    <td>
                        <a href="supprimer_admin.php?id_userAdmin=<?= $admins['id_userAdmin'] ?>" class="btn btn-danger border border-warning">SUPPRIMER</a>
                    </td>
                </tr>
        <?php
            }

        ?>


        </tbody>
    </table>
</div>





<!---------------------SESSION FAILED------------------->

<?php
}else{
    header("location: index.php");
}
?>

</body>
</html>