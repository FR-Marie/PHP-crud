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

    
    
    <title>Editer produit</title>

    

</head>

<body>

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

<!---------------------------TRAITEMENT IMAGE---------------------------------->
<?php
if(isset($_FILES["image_produit"])){

    //répertoire de destination des images
    $repertoireImage = "img/";

    //répertoire de destination + composante finale d'un chemin (basename) avec en paramètres
    //un tableau associatif multi dim $_FILES["image_produit"]["name"] (name = le nom de l'image)
    $image_produit = $repertoireImage . basename($_FILES["image_produit"]["name"]);

    //Image téléchargée du formulaire ($_post) avec son répertoire, son nom et son image
    $_POST["image_produit"] = $image_produit;

    if(move_uploaded_file($_FILES["image_produit"]["tmp_name"], $image_produit)){
        ?>
            <div class="alert alert-success w-50 m-auto">
                <p>Fichier validé et téléchargé avec succès</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
        <?php
    }else{
        ?>
            <div class="alert alert-danger w-50 m-auto">
                <p>Erreur lors du téléchargement de l'image</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
        <?php
    }
    }else{
        ?>
            <div class="alert alert-danger w-50 m-auto">
                <p>Format fichier invalide</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
        <?php
    }
?>
<!-----------------------------TRAITEMENT DE L'EDITION PRODUIT-------------------------------->
<?php

if($dbh){
    $sql = "UPDATE `produits_peluches` SET `nom_produit`=?,`marque_produit`=?,`sousTitre_produit`=?,`description_produit`=?,`prix_produit`=?,`stock_produit`=?,`date_depot`=?,`image_produit`=? WHERE id_produit = ?";
    
    $request = $dbh->prepare($sql);
    
    $id = $_GET["id_produit_editer"];
    $request->execute([
            $_POST["nom_produit"],
            $_POST["marque_produit"],
            $_POST["sousTitre_produit"],
            $_POST["description_produit"],
            $_POST["prix_produit"],
            $_POST["stock_produit"],
            $_POST["date_depot"],
            $_POST["image_produit"],
            $id
    ]);

        if($request){
            ?>
            <div>
                <p class="alert alert-success">Réussite de la mise à jour produit</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }else{
            ?>
            <div>
                <p class="alert alert-danger">Echec de la mise à jour produit</p>
                <a href="accueil.php" class="btn btn-warning">Retour accueil</a>
            </div>
            <?php
        }
    }

?>




<!---------------------SESSION FAILED------------------->
<?php
    }else{
        header("location: index.php");
    }
    ?>
            
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>