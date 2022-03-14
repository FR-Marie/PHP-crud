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

    
    
    <title>Ajouter un produit</title>

    

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


<!---------------------------REQUETE SQL----------------------------->



<!---------------------------CONTENU----------------------------->
<!--------------------------------------------------------------->
<div class="container-fluid">
    <div class="row">

        <h2 class="text-white text-center mt-5">Ajout de produit</h2>

        <form action="traitement_ajouter_produit.php" method="POST" enctype="multipart/form-data" class="text-warning bg-success rounded w-50 mt-3 border border-warning">

                <div class="mt-5 mb-2 ms-5">
                    <label for="nom_produit" class="d-block">Nom produit:</label>
                        <input type="text" name="nom_produit">
                </div>

                <div class="mb-2 ms-5">
                    <label for="marque_produit" class="d-block">Marque:</label>
                        <input type="text" name="marque_produit">
                </div>

                <div class="mb-2 ms-5">
                    <label for="sousTitre_produit" class="d-block">Sous titre produit:</label>
                        <input type="text" name="sousTitre_produit">
                </div>

                <div class="mb-2 ms-5">
                    <label for="description_produit" class="d-block">Description produit:</label>
                        <textarea name="description_produit" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="mb-2 ms-5">
                    <label for="prix_produit" class="d-block">Prix:</label>
                        <input type="number" step="0.01" min=0 name="prix_produit">
                </div>

                <div class="mb-2 ms-5">
                    <label for="stock_produit" class="d-block">Stock:</label>
                        <select name="stock_produit" id="">
                            <option value=""></option>
                            <option value="1">oui</option>
                            <option value="0">non</option>
                        </select>
                </div>

                <div class="mb-2 ms-5">
                    <label for="date_depot" class="d-block">Date dépôt:</label>
                        <input type="date" name="date_depot">
                </div>

                <div class="mb-4 ms-5">
                    <label for="image_produit" class="d-block"></label>
                        <input type="file" name="image_produit">
                </div>


            <!-------------BTN SUBMIT------------>
            <button type="submit" class="btn btn-outline-warning mb-5 ms-5">VALIDER</button>

        </form>

        

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