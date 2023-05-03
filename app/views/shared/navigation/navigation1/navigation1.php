<nav class="w-100">
    <div class="navContainer d-flex justify-content-between align-items-center p-1">
        <div class="d-flex justify-content-center align-items-center">
            <a href="/accueil">
                <img class="kyaafLogo" src="../../../../media/images/KYAAF_Logo.png">
            </a>
            <div class="options d-flex justify-content-center align-items-center flex-wrap mx-2">
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/accueil"><span class="material-icons">home</span>Accueil</a>
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/recherche"><span class="material-icons">search</span>Recherche</a>
            </div>
        </div>
        <div class="text-right ">
            <a class="btn btn-primary text-white m-1" data-toggle="modal" data-target="#authModal">
                Se connecter
            </a>
            <a class="btn btn-primary text-white m-1" href="/inscription">
                S'inscrire
            </a>
        </div>
    </div>
    
    <?php include "views/shared/navigation/notification.php";?>

</nav>

<?php include "views/shared/navigation/navigation1/authentication/authentication.php";?>

