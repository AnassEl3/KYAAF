<?php
$title = "Gestion des annonces validées";
require 'views/shared/header.php';
?>
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
                                <li class="nav-item d-flex justify-content-between align-items-center not-activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/dashWhite.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-light small" href="/dashboard">Vue d'ensemble</a>
                                </li>
                                <li class="nav-item d-flex justify-content-between align-items-center not-activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/gestionWhite.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-light small" href="/gestion-annonce">Gestion des
                                        annonces</a>
                                </li>
                                <li class="nav-item  d-flex justify-content-between align-items-centers activated my-2 p-2">
                                    <img class="img-fluid" src="/assets/img/onlineBlue.svg" width="30px" height="30px"
                                         alt="ic">
                                    <a class="fw-bold nav-link text-primary small" href="/gestion-annonce-en-ligne">Annonces
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
                                    <p class="display-6 fw-normal">Nombre d'annonces validées</p>
                                    <p class="display-4 text-kyaaf-blue fw-bold"><?= Annonce::getNbrValidAnnonces(Connection::getConn()) ?></p>
                                </div>
                            </div>
                            <div class="m-2 row">
                                <div class="col">
                                    <ul class="list-group">
                                        <?php
                                        foreach (Annonce::getAdminOnlineAnnonces(Connection::getConn(), $accountInfos->getIdCompte()) as $annonce) {
                                            if ($annonce->getEtat() == "a") {
                                                echo '<li class="my-2 list-item-perso-good p-3 fw-bold d-flex justify-content-between align-items-center position-relative">';
                                            } else {
                                                echo '<li class="my-2 list-item-perso-disabled p-3 fw-bold d-flex justify-content-between align-items-center position-relative">';
                                            }
                                            ?>
                                            <div class="position-absolute date-zone"
                                                 style="border: #7f7fa7 2px solid; left: 5px; top: -5px; background-color: #dbdbea; color: #7f7fa7; border-radius: 4px; padding: 0 4px">
                                                Il y'a <?= $annonce->getAgeAnn() ?> jours
                                            </div>
                                            <span class="mb-0"><?= substr($annonce->getDescAnn(), 0, 30) . "..." ?></span>
                                            <div class="d-flex flex-row">
                                                <a class="btn btn-outline-danger mx-2"
                                                   href="/deny-annonce/<?= $annonce->getIdAnn() ?>">Rejeter</a>
                                                <a class="btn btn-outline-primary"
                                                   href="/gestion-annonce-en-ligne/<?= $annonce->getIdAnn() ?>">Voir</a>
                                            </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
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