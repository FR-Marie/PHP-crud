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

    
    
    <title>Détails produit</title>

    

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


            if($dbh){
                $sql = "SELECT * FROM produits_peluches WHERE id_produit = ?";
                $produitID = $_GET["id_produit"];
                
                $request = $dbh->prepare($sql);
                $request->bindParam(1, $produitID);
                
                $request->execute();
                
                $details = $request->fetch(PDO::FETCH_ASSOC);
                }
            ?>

    </div>
</div>


<?php


?>

<div class="container-fluid mt-5 bg-warning">
    <div class="row text-center w-50 bg-light m-auto p-5">

                <h2 class="h2DetailsProduits text-danger"> <?= $details["nom_produit"] ?> </h2>

                <div class="h-100 mt-5">
                    <img src="<?= $details["image_produit"] ?>" alt="<?= $details["nom_produit"] ?>" title="<?= $details["nom_produit"] ?>">
                </div>

                <div class="mt-3 w-50 m-auto p-5">
                    <?= $details["description_produit"] ?>
                </div>

                <form action="" method="POST" class="pb-2">
                <button id="btn-ajout-panier" type="submit" name="btn-ajouterAuPanier" class="rounded bg-success text-warning mb-5 p-2">Ajouter au panier</button>
                </form>

                <!---------BTN SUPPRIMER PRODUIT-------->
            <div>
                <a href="supprimer_produit.php" class="btn border border-danger text-danger">Supprimer produit</a>
            </div>
                
    


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