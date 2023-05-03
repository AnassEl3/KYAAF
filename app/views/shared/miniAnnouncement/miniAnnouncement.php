<?php
    include_once "controllers/classes/Announcement.php";
    include_once "controllers/classes/Accounts.php";
    include_once "controllers/classes/Info.php";

    $thumbnail = Announcement::getThumbnail(Connection::getConn(), $announcement["miniature"]);
    $announcer = Accounts::getUserInfo(Connection::getConn(), $announcement["idCompte"]);
    $categorie = Info::getUpperCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $type = Info::getSubCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $city = Info::getCity(Connection::getConn(), $announcement["idVille"]);

?>

<div class="miniAnnouncement rounded d-flex justify-content-between align-items-end flex-grow-1 flex-wrap m-1 w-100">
    <div class="d-flex justify-content-center align-items-center flex-wrap flex-sm-nowrap">
        <div class="d-flex justify-content-center align-items-center">
            <img class="miniThumbnail rounded m-1 mx-3" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
        </div>
        <div class="d-flex justify-content-center align-items-start flex-column m-1">
            <h3 class="miniAnnonceTitle text-primary"><?= $announcement["titre"] ?></h3>
            <p class="d-flex justify-content-start align-items-center m-0 p-1">
                <span class="material-icons text-muted pr-1 m-0">schedule</span> 
                <?= $announcement["dateAnn"] ?>
            </p>
            <p class="d-flex justify-content-start align-items-center text-capitalize m-0 p-1">
                <span class="material-icons text-muted pr-1 m-0">account_circle</span> 
                <?= $announcer["nom"] . " " . $announcer["prenom"] ?>
            </p>
            <p class="miniCity d-flex justify-content-start align-items-center m-0 p-1">
                <span class="material-icons text-muted pr-1 m-0">place</span> 
                <?= $city["nomVille"]?>
            </p>
            
            <p class="miniCategorie m-0 mt-1 p-0">
                <span class="text-muted text-uppercase">Catégorie:</span> 
                <?= $categorie["nomCat"]?>
            </p>
            <p class="miniType m-0 p-0">
                <span class="text-muted text-uppercase">Type:</span> 
                <?= $type["nomCat"]?>
            </p>
            
        </div>
    </div>
    <div class="d-flex justify-content-end align-items-center flex-grow-1">
        <a class="d-flex justify-content-center align-items-center btn btn-primary text-white p-1 m-1" href="/annoncement?id=<?= $announcement["idAnn"] ?>">
            <span class="material-icons px-1">visibility</span>
            Voir l'annonce
        </a>
    </div>
</div>