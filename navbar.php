<nav class="navbar">

<!---------logo---------->
    <div class="logoAccueil text-white">
        <a href="accueil.php"><img src="img/logo-bidon.png" alt="Accueil" title="Accueil"></a>
    </div>


<!---------navbar---------->
    <div class="nav-links-pack d-flex ms-5">
        <div class="nav-link">
        <a href="#"><i class="fa-solid fa-question px-1"></i>FAQ</a>
        </div>
        <div class="nav-link">
        <a href="#"><i class="fa-solid fa-envelope px-1"></i>CONTACT</a>
        </div>
        
    </div>

    <form class="rechercher d-flex m-auto">
        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn-search" type="submit">Search</button>
    </form>

    <div class="nav-links-pack d-flex me-5">
        <div class="nav-link">
        <a href="#"><i class="fa-solid fa-user px-1"></i>PROFIL</a>
        </div>
        <div class="nav-link">
        <a href="gestion_admins.php"><i class="fa-solid fa-basket-shopping px-1"></i>ADMINS</a>
        </div>
    </div>

    <!---------menu responsive---------->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="nav-responsive bg-danger">
        <form action="" method="POST">
            <button type="submit" name="btn-deconnexion" class="btn-deconnexion-accueil">DECONNEXION</button>
        </form>
    </div>





    <!---------------------DECONNEXION------------------------>
    <?php
        if(isset($_POST["btn-deconnexion"])){
            echo "btn-deconnexion OK";
            session_unset();
            session_destroy();
            header("location: index.php");
        }
    ?>

</nav>

