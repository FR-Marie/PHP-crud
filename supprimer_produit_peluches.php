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

    
    
    <title>Supprimer un produit</title>

    

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

<!--------------------------CONNEXION A LA BD--------------------------->
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


<!---------------------------REQUETE SQL PELUCHES----------------------------->
<?php
if($dbh){
    $sql = "SELECT * FROM produits_peluches WHERE id_produit = ?";
    $id_produit = $_GET["id_produit_delete"];

    $request = $dbh->prepare($sql);
    $request->bindParam(1, $id_produit);

    $request->execute();

    $detailsProduitDelete = $request->fetch(PDO::FETCH_ASSOC);
    //var_dump($id_produit_delete);
}
?>



<!------------------------------CONTENU----------------------------------->
<!------------------------------------------------------------------------>
<div class="container-fluid">
    <div class="row">

        <h2 class="text-white text-center mt-5">Suppression de produit</h2>

        <div id="produitDELETE" class="mt-5 text-center text-warning">
            <h4><?=$detailsProduitDelete["nom_produit"]?></h4>
            <p><img src="<?= $detailsProduitDelete["image_produit"] ?>" alt="<?=$detailsProduitDelete["nom_produit"]?>" title="<?=$detailsProduitDelete["nom_produit"]?>"></p>
            <p>Prix TTC : <?= $detailsProduitDelete["prix_produit"]?> €</p>
        </div>

    </div>

    <div class="row mt-5">

<!---------------------BTN CONFIRMER LA SUPPRESSION DU PRODUIT + ANNULER (RETOUR ACCUEIL)------------------->
        <div class="text-center d-flex justify-content-center">
            <!--btn confirmer-->
            <form action="" method="POST">
            <button id="btn-delete-produit" type="submit" name="btnDeleteProduit" class="btn text-white me-2">Confirmer</button>
            </form>
            <!--btn annuler-->
            <a href="accueil.php" id="btn-annuler-delete-produit" class="btn btn-primary text-white ms-2">Annuler</a>
        </div>

        <?php

        if(isset($_POST["btnDeleteProduit"])){
            //echo "btn supp ok";

            ///////////////////////////////////////
            $sql = "DELETE FROM produits_peluches WHERE id_produit =?";

            ///////////////////////////////////////
            $delete = $dbh->prepare($sql);
            $id_produit = $_GET["id_produit_delete"];

            ///////////////////////////////////////
            $delete->bindParam(1, $id_produit);
            $delete->execute();

            if($delete){
                ?>
                <div class="alert alert-success w-50 m-auto text-center">Suppression réussie</div>
                <div class="text-center">
                <a href="accueil.php" class="btn btn-warning text-danger w-25 m-auto text-center mt-5">Retour accueil</a>
                </div>
                    <style>
                        #produitDELETE{
                            display: none;
                        }
                        #btn-delete-produit{
                            display: none;
                        }
                        #btn-annuler-delete-produit{
                            display: none;
                        }
                    </style>
                <?php
            }else{
                ?>
                <div class="alert alert-danger w-50 m-auto text-center">Echec de la Suppression du produit" <?= $detailsProduitDelete["nom_produit"] ?>"</div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>