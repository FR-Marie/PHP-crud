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

    
    
    <title>Accueil</title>

    

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


<!------------------------BASE DE DONNEES-------------------------->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 text-center">
        <?php
$user = "root";
$pass = "";

try{

    //instance de la classe PDO (PHP DATA OBJECT!)
    $dbh = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", $user, $pass);

    //debug ATTR_ERRMODE : rapport d'erreurs.  ERRMODE_EXCEPTION : émet une exception.
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
    <div class="">
    <p class="text-center bg-dark text-warning p-1">Connexion à PDO MySQL réussie</p>
    </div>
    <?php
}catch(PDOException $a){
    ?>
    <div>
    <p class="text-center bg-dark text-warning p-1">Erreur! <?= $a->getMessage() ?></p>
    </div>
    <?php
    die();
}

//si la base de données existe:
if($dbh){
//requête SQL de séléection des produits (copier/coller phpmyadmin -> SQL -> SELECT)
$sql = "SELECT * FROM produits_peluches";
$table2 = "SELECT * FROM produits_consoles";
$table3 = "SELECT * FROM produits_jeux_de_societe";

//On accède à la METHODE QUERY grâce à PDO
//PDO::query() prépare et exécute une requête SQL en un seul appel de fonction, retournant la requête en tant qu'objet PDOstatement(état des sonnées).
//PDOStatement = Représente une requête préparée et, une fois exécutée, le jeu de résultats associé.
$statment = $dbh->query($sql);
$statment_consoles = $dbh->query($table2);
$statment_jeuxDeSociete = $dbh->query($table3);
}

?>
        </div>
    </div>
</div>

<!------------------------ENTREE PAGE-------------------------->
<div class="container-fluid">
    <div class="row text-white text-center">

        <div class="bienvenue text-white">
        <p class="alert alert-success w-25 m-auto">Bonjour <?= $_SESSION["email"] ?> ! </p>
        </div>

        <h1>TOYS FOR ALL</h1>


<!------------------------BTN POUR AJOUTER UN PRODUIT-------------------------->
        <div class="text-center">
            <a href="ajouter_produit.php" class="btn btn-danger text-white btn-outline-primary rounded">AJOUTER UN PRODUIT</a>
        </div>

        
    </div>
</div>


<!------------------------AFFICHAGE DES PRODUITS PELUCHES-------------------------->
<div class="container-fluid mt-5 border border-white p-3">
    <div class="row">

        <h2 class="h2-peluches text-white mt-5">Les peluches</h2>

        <?php
        foreach($statment as $produits_peluches){
            //var_dump($produits_peluches);
        ?>
        <div class="col-lg-2 col-sm-6 p-5">

                <div class="cardPeluches border border-success card bg-warning">

                    <div class="text-danger bg-warning card-header h-auto text-center p-0">
                        <h4 class="h4-consoles"> <?= $produits_peluches["nom_produit"] ?> </h4>
                    </div>
                    
                    <div class="card-bodyPeluches card-body border border-warning">
                        <div class="card-img text-center">
                            <img src=" <?= $produits_peluches["image_produit"] ?>" alt="<?= $produits_peluches["nom_produit"] ?>" title="<?= $produits_peluches["nom_produit"] ?>">
                        </div>
                        <div class="card-title text-center pt-3">
                            <p> <?= $produits_peluches["sousTitre_produit"] ?></p>
                        </div>
                        <div class="card-text text-white text-center">

                        <!------------BTN DETAILS PRODUIT----------->
                            <a href="details_produitsPeluches.php?id_produit=<?=$produits_peluches["id_produit"]?>" class="btn btn-success">►Détails</a>
                            <p class="">Prix : <?= $produits_peluches["prix_produit"] ?></p>

                            <?php 
                            if($produits_peluches["stock_produit"] == true){
                                ?>
                                <span class="text-success">disponible</span>
                                <?php
                            }else{
                                ?>
                                <span class="text-danger">indisponible</span>
                                <?php
                            }
                            ?>
                         
                        </div>     
                        </div>

                        <div class="cardFooterConsoles card-footer border border-warning">
                                <!---------BTN PANIER-------->
                                <form action="" method="POST" class="pb-2">
                                <button id="btn-ajout-panier" type="submit" name="btn-ajouterAuPanier" class="rounded bg-success p-1 text-white">Ajouter au panier</button>
                                </form>

                                <!---------BTN SUPPRIMER PRODUIT-------->
                                <div>
                                    <a href="supprimer_produit_peluches.php?id_produit_delete=<?=$produits_peluches["id_produit"]?>" class="btn border border-danger text-danger">Supp produit</a>
                                </div>

                                <!---------BTN EDITER PRODUIT-------->
                                <div>
                                    <a href="editer_produit_peluches.php" class="btn btn-warning mt-2">Editer produit</a>
                                </div>
                        </div>
                </div>
                             
         

        </div>

        <?php
        }
        ?>

    </div>
</div>

<!------------------------AFFICHAGE DES PRODUITS CONSOLES-------------------------->
<div class="container-fluid mt-5 border border-white p-5">
    <div class="row">

        <h2 class="h2-peluches text-white mt-5">Les consoles de jeux</h2>

        <?php
        foreach($statment_consoles as $produits_consoles){
            //var_dump($produits_consoles);
        ?>
        <div class="col-lg-2 col-sm-6 p-5">

                <div class="cardConsoles card h-100">

                    <div class="cardHeaderConsoles text-warning card-header border border-warning">
                        <h4 class="h4-consoles"> <?= $produits_consoles["nom_produit"] ?> </h4>
                    </div>
                    
                    <div class="card-body border border-warning">
                        <div class="card-img">
                            <img src=" <?= $produits_consoles["image_produit"] ?>" alt="">
                        </div>
                        <div class="card-title text-center">
                            <p> <?= $produits_consoles["sousTitre_produit"] ?></p>
                        </div>
                        <div class="card-text">

                            <!------------BTN DETAILS PRODUIT----------->
                            <a href="details_produitsConsoles.php?id_produit=<?=$produits_consoles["id_produit"]?>" class="btn btn-warning">►Détails</a>
                            <p>Prix : <?= $produits_consoles["prix_produit"] ?></p>

                            <?php 
                            if($produits_consoles["stock_produit"] == true){
                                ?>
                                <span class="text-success">disponible</span>
                                <?php
                            }else{
                                ?>
                                <span class="text-danger">indisponible</span>
                                <?php
                            }
                            ?>
                         
                        </div>     
                        </div>

                        <div class="cardFooterConsoles card-footer border border-warning">
                                <!---------BTN PANIER-------->
                                <form action="" method="POST" class="pb-2">
                                <button id="btn-ajout-panier" type="submit" name="btn-ajouterAuPanier" class="rounded bg-success p-1 text-white">Ajouter au panier</button>
                                </form>

                                <!---------BTN SUPPRIMER PRODUIT-------->
                                <div>
                                    <a href="supprimer_produit_consoles.php?id_produit_delete=<?=$produits_consoles["id_produit"]?>" class="btn border border-danger text-danger">Supp produit</a>
                                </div>

                                <!---------BTN EDITER PRODUIT-------->
                                <div>
                                    <button type="submit" name="editer_produit" class="btn btn-warning mt-2">Editer produit</button>
                                </div>
                        </div>
                </div>
                             
         

        </div>

        <?php
        }
        ?>

    </div>
</div>



<!------------------------AFFICHAGE DES PRODUITS JEUX DE SOCIETE-------------------------->
<div class="container-fluid mt-5 border border-white">
    <div class="row justify-content-center">

    <h2 class="h2-peluches text-white mt-5">Les jeux de société</h2>
        <?php
        foreach($statment_jeuxDeSociete as $produit_jeuxDeSociete){
            //var_dump($produit);
            
            ?>
    <div class="col-lg-2 col-sm-6 p-5">

    <div class="cardConsoles card h-100 text-center">

        <div class="cardHeaderJeuxDeSociete bg-danger text-warning card-header border border-warning">
            <h4 class="h4-consoles"> <?= $produit_jeuxDeSociete["nom_produit"] ?> </h4>
        </div>
        
        <div class="card-body border border-success">
            <div class="card-img">
                <img src=" <?= $produit_jeuxDeSociete["image_produit"] ?>" alt="<?= $produit_jeuxDeSociete["nom_produit"] ?>" title="<?= $produit_jeuxDeSociete["nom_produit"] ?>">
            </div>
            <div class="card-title text-center">
                <p> <?= $produit_jeuxDeSociete["sousTitre_produit"] ?></p>
            </div>
            <div class="card-text">

            <!------------BTN DETAILS PRODUIT----------->
                <a href="details_produitJeuxSociete.php?id_produit=<?=$produit_jeuxDeSociete["id_produit"]?>" class="btn btn-warning">►Détails</a>
                <p>Prix : <?= $produit_jeuxDeSociete["prix_produit"] ?></p>

                <?php 
                if($produit_jeuxDeSociete["stock_produit"] == true){
                    ?>
                    <span class="text-success">disponible</span>
                    <?php
                }else{
                    ?>
                    <span class="text-danger">indisponible</span>
                    <?php
                }
                ?>
            
            </div>     
            </div>

            <div class="cardFooterConsoles card-footer border border-warning">
                    <!---------BTN PANIER-------->
                    <form action="" method="POST" class="pb-2">
                    <button id="btn-ajout-panier" type="submit" name="btn-ajouterAuPanier" class="rounded bg-success p-1 text-white">Ajouter au panier</button>
                    </form>

                    <!---------BTN SUPPRIMER PRODUIT-------->
                    <div>
                        <a href="supprimer_produit_jeuxDeSociete.php?id_produit_delete=<?=$produit_jeuxDeSociete["id_produit"]?>" class="btn border border-danger text-danger">Supp produit</a>
                    </div>

                    <!---------BTN EDITER PRODUIT-------->
                    <div>
                        <button type="submit" name="editer_produit" class="btn btn-warning mt-2">Editer produit</button>
                    </div>
        </div>
</div>
             


    </div>

    <?php
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