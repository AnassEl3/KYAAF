<?php
$title = "Vue d'ensemble";
require 'views/shared/header.php';
?>
<link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
<div class="container-fluid full-height">
    <div class="row h-100">
        <div class="col-3 bg-kyaaf-blue-gradient p-4 h-100 scroll-overflow">
            <div class="container-fluid text-light d-flex flex-column h-100">
                <div class="row my-2">
                    <div class="col d-flex align-items-center justify-content-center">
                        <img class="img-fluid" width="200px" src="/assets/img/logo-white.svg" alt="Logo Kyaaf">
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col divider"></div>
                </div>
                <div class="row my-2 flex-grow-1">
                    <div class="col">
                        <div class="container-fluid">
                            <ul class="nav flex-column">
                                <li class="nav-item d-flex justify-content-between align-items-center activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/dashBlue.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-primary small" href="/dashboard">Vue d'ensemble</a>
                                </li>
                                <li class="nav-item  d-flex justify-content-between align-items-centers not-activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/gestionWhite.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-light small" href="/gestion-annonce">Gestion des
                                        annonces</a>
                                </li>
                                <li class="nav-item d-flex justify-content-between align-items-center not-activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/onlineWhite.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-light small" href="/gestion-annonce-en-ligne">Annonces
                                        validées</a>
                                </li>
                                <li class="nav-item d-flex justify-content-between align-items-center not-activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/expiredWhite.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-light small" href="/annonce-expiree">Annonces
                                        expirées</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col divider"></div>
                </div>
                <div class="row my-2">
                    <div class="col">
                        <a href="/disconnect" class="btn button-deconn fw-bold text-light px-4 w-100">Deconnexion</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-9 bg-light h-100">
            <div class="container-md d-flex flex-column h-100">
                <div class="row my-2">
                    <div class="col d-flex flex-row justify-content-between align-items-center">
                        <h1><?php echo $title; ?></h1>
                        <div class="d-flex flex-row align-items-center">
                            <p class="p-0 me-2 mb-0 fw-bold"><?php echo strtoupper($accountInfos->getPrenom() . " " . $accountInfos->getNom()); ?></p>
                            <img class="rounded-circle img-fluid"
                                 src="data:image/png;base64,<?php echo base64_encode($accountInfos->getPhoto()); ?>"
                                 height="60px" width="60px" alt="photo de profil utilisateur">
                        </div>
                    </div>
                </div>
                <div class="row flex-grow-1 my-2 scroll-overflow">
                    <div class="col">
                        <div class="container-fluid">
                            <div class="m-2 row prime-heading-card">
                                <div class="col d-flex flex-row justify-content-around align-items-center">
                                    <p class="display-6 fw-normal">Nombre d'annonces en ligne</p>
                                    <p class="display-4 text-kyaaf-blue fw-bold"><?= Annonce::getNbrOnlineAnnonces(Connection::getConn()) ?></p>
                                </div>
                            </div>
                            <div class="m-2 row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 text-light">
                                <div class="col p-1">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col bg-kyaaf-blue-gradient kyaaf-card border p-4">
                                                <div class="container d-flex flex-column justify-content-around align-items-center">
                                                    <p class="display-6 text-center">Nombre d'annonces en attente de
                                                        validation</p>
                                                    <p class="display-5 fw-normal text-center"><?= Annonce::getNbrPendingAnnonces(Connection::getConn()) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-1">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col kyaaf-card bg-kyaaf-green-gradient border p-4">
                                                <div class="container d-flex flex-column justify-content-around align-items-center">
                                                    <p class="display-6 text-center">Nombre d'annonces validées</p>
                                                    <p class="display-5 fw-normal text-center"><?= Annonce::getNbrValidAnnonces(Connection::getConn()) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-1">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col kyaaf-card bg-kyaaf-red-gradient border p-4">
                                                <div class="container d-flex flex-column justify-content-around align-items-center">
                                                    <p class="display-6 text-center">Nombre d'annonces regetées</p>
                                                    <p class="display-5 fw-normal text-center"><?= Annonce::getNbrDeniedAnnonces(Connection::getConn()) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col p-1">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col kyaaf-card bg-kyaaf-orange-gradient border p-4">
                                                <div class="container d-flex flex-column justify-content-around align-items-center">
                                                    <p class="display-6 text-center">Nombre d'annonces expirées</p>
                                                    <p class="display-5 fw-normal text-center"><?= Annonce::getNbrExpiredAnnonces(Connection::getConn()) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>