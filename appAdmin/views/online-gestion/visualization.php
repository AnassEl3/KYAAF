<?php
if (!isset($idAnn)) {
    $_SESSION['notification'] = "no-view";
    header('location:/gestion-annonce-en-ligne');
} else {
    $title = "Gestion de l'annonce " . $idAnn;
    $annonce = Annonce::getAdminOnlineAnnonce(Connection::getConn(), $idAnn, $accountInfos->getIdCompte());
    if ($annonce == null) {
        $_SESSION['notification'] = "no-view";
        header('location:/gestion-annonce-en-ligne');
    } else {
        if (!in_array($annonce->getEtat(), array('a', 'd'))) {
            $_SESSION['notification'] = "no-view";
            header('location:/gestion-annonce-en-ligne');
        } else {
            $annonceur = Compte::getUser(Connection::getConn(), $annonce->getIdCompte());
            if ($annonceur == null) {
                $_SESSION['notification'] = "no-view";
                header('location:/gestion-annonce-en-ligne');
            }
        }
    }
}
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
                    <div class="col h-100">
                        <div class="container-fluid prime-heading-card p-3">
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="container d-flex justify-content-start align-items-center">
                                        <img height="80px" width="80px" class="rounded-circle"
                                             src="data:image/png;base64,<?= base64_encode($annonceur->getPhoto()) ?>"
                                             alt="Photo de profil de l'annonceur">
                                        <div class="d-flex flex-column justify-content-center align-items-start ms-4">
                                            <span class="display-6 fw-bold"><?= $annonceur->getNom() . " " . $annonceur->getPrenom() ?></span>
                                            <small class="display-6"><?= $annonce->getNomCat() ?> </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <div class="container d-flex justify-content-center align-items-center">
                                        <img class="img-fluid" style="height: 400px"
                                             src="data:image/png;base64,<?= base64_encode($annonce->getPhoto()) ?>"
                                             alt="image de l'annonce">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col d-flex flex-row justify-content-between align-items-center">
                                                <div class="d-flex flex-row justify-content-start align-items-end mb-4">
                                                    <span class="fw-bold display-6"><?= $annonce->getTitre() ?></span>
                                                    <small class="ms-3 small text-secondary fw-bold">Publiée
                                                        : <?= $annonce->getDateAnn() ?></small>
                                                </div>
                                                <span class="fw-normal display-6"><?= $annonce->getPrix() ?> DHS</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="border-start border-3 border-primary ps-4"><?= nl2br($annonce->getDescAnn()) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <div class="container d-flex justify-content-around align-items-center">
                                        <a href="/gestion-annonce-en-ligne" class="btn btn-light flex-grow-1 mx-4">Ignorer</a>
                                        <a href="/deny-annonce-en-ligne/<?= $idAnn ?>"
                                           class="btn bg-kyaaf-blue-gradient flex-grow-1 mx-4 text-light">Rejeter</a>
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