<nav class="w-100">
    <div id="bigNavModal" class="navContainer d-none justify-content-between align-items-center p-1">
        <div class="d-flex justify-content-center align-items-center">
            <a href="/accueil">
                <img class="kyaafLogo" src="../../../../media/images/KYAAF_Logo.png">
            </a>
            <div class="options d-flex justify-content-center align-items-center flex-wrap mx-2">
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/accueil"><span class="material-icons">home</span>Accueil</a>
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/recherche"><span class="material-icons">search</span>Recherche</a>
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/mesannoncements"><span class="material-icons">campaign</span>Mes annonces</a>
                <a class="d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark mx-1" href="/favories"><span class="material-icons">favorite</span>Favoris</a>
            </div>
        </div>
        <div class="text-right  d-flex justify-content-center align-items-center">
            <a class="m-1" href="/moncompte">
                <img class="accountImg bg-primary rounded-circle m-1 p-0" src="data:image/*;charset=utf8;base64,<?= base64_encode($accountInfos['avatar']); ?>">
            </a>
            <a class="d-flex justify-content-center align-items-center btn btn-success text-white text-nowrap m-1" href="/creerannonce">
                <span class="material-icons text-white m-0 p-0">campaign</span>
                Créer annonce
            </a>
            <a class="d-flex justify-content-center align-items-center btn btn-danger text-white m-1 " href="/deconnect">
                <span class="material-icons text-white m-0 p-0">power_settings_new</span>
                Déconnecter
            </a>
        </div>
    </div>
    <div id="smallNavModal" class="navContainer d-none justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-items-center">
            <a href="/accueil">
                <img class="kyaafLogo" src="../../../../media/images/KYAAF_Logo.png">
            </a>
        </div>
        <div class="text-right  d-flex justify-content-center align-items-center flex-wrap">
            <a class="m-1" href="/moncompte">
                <img class="accountImg bg-primary rounded-circle m-1 p-0" src="data:image/*;charset=utf8;base64,<?= base64_encode($accountInfos['avatar']); ?>">
            </a>
            <div class="dropdown">
                <a class="btn btn-primary rounded p-0 m-1" id="miniNavBtn" data-toggle="dropdown">
                    <span class="miniNavIcon material-icons p-1 text-white">menu</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark rounded-0" href="/accueil"><span class="material-icons">home</span>Accueil</a>
                    <a class="dropdown-item d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark rounded-0" href="/recherche"><span class="material-icons">search</span>Recherche</a>
                    <a class="dropdown-item d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark rounded-0" href="/mesannoncements"><span class="material-icons">campaign</span>Mes annonces</a>
                    <a class="dropdown-item d-flex justify-content-center align-items-center btn h5 text-decoration-none text-dark rounded-0" href="/favories"><span class="material-icons">favorite</span>Favoris</a>
                    <div class="dropdown-divider"></div>
                    <a class="d-flex justify-content-center align-items-center btn btn-success text-white my-1 rounded-0 w-100" href="/creerannonce">
                        <span class="material-icons text-white m-0 p-0">add</span>
                        Créer annonce
                    </a>
                    <a class="d-flex justify-content-center align-items-center btn btn-danger text-white my-1 rounded-0 w-100" href="/deconnect">
                        <span class="material-icons text-white m-0 p-0">power_settings_new</span>
                        Déconnecter
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <?php include "views/shared/navigation/notification.php";?>

</nav>