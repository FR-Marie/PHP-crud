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

<!------------------------------------------------------------------------->

<?php

$sql = "DELETE FROM `users_admins` WHERE id_userAdmin = ?";

$id = $_GET["id_userAdmin"];

$deleteAdmin = $dbh->prepare($sql);

$deleteAdmin->bindParam(1, $id);

$deleteAdmin->execute();


if($deleteAdmin){
    ?>
    <div class="alert alert-warning w-50 m-auto text-center mt-5">
        <p >Supression réussie</p>
        <a href="gestion_admins.php" class="btn btn-warning text-success border border-primary">Gestion admins</a>
        <a href="accueil.php" class="btn btn-primary text-white border border-warning">Retour accueil</a>
    </div>

    <?php
}else{
    ?>
    <div class="alert alert-warning w-50 m-auto text-center mt-5">
        <p >Echec de la suppression</p>
        <a href="gestion_admins.php" class="btn btn-warning text-success border border-primary">Gestion admins</a>
        <a href="accueil.php" class="btn btn-primary text-white border border-warning">Retour accueil</a>
    </div>
    <?php
}

?>





<!---------------------SESSION FAILED------------------->

<?php
}else{
    header("location: index.php");
}
?>

</body>
</html>