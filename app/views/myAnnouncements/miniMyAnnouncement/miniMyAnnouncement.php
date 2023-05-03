<?php
    include_once "controllers/classes/Announcement.php";
    include_once "controllers/classes/Accounts.php";
    include_once "controllers/classes/Info.php";

    $thumbnail = Announcement::getThumbnail(Connection::getConn(), $announcement["miniature"]);
    $announcer = Accounts::getUserInfo(Connection::getConn(), $announcement["idCompte"]);
    $categorie = Info::getUpperCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $type = Info::getSubCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $city = Info::getCity(Connection::getConn(), $announcement["idVille"]);

    switch ($announcement["etat"]) {
        case 'a':
            $className = "activated";
            break;

        case 'd':
            $className = "deactivated";
            break;

        case 'r':
            $className = "rejected";
            break;
        
        case 'e':
            $className = "expired";
            break;

        case 't':
            $className = "processed";
            break;
        
        default:
            $className = "processed";
            break;
    }
?>

<div class="miniMyAnnouncement rounded w-75 m-1 p-1 <?= $className ?>">
    <div class="d-flex justify-content-start align-items-start flex-column rounded">
        <div class="d-flex justify-content-start align-items-end flex-wrap">
            <div class="d-flex justify-content-around align-items-center flex-wrap flex-sm-nowrap">
                <img class="miniThumbnail rounded m-1" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
                <div class="d-flex justify-content-center align-items-start flex-column mt-1 mx-3">
                    <p class="title text-primary h2"><?= $announcement["titre"] ?></p>
                    <p class="m-0 p-0">
                        <span class="text-muted text-uppercase">Catégorie:</span> 
                        <?= $categorie["nomCat"]?>
                    </p>
                    <p class="m-0 p-0">
                        <span class="text-muted text-uppercase">Type:</span> 
                        <?= $type["nomCat"]?>
                    </p>

                    <?php
                        switch ($announcement["etat"]) {
                            case 'a':
                                echo '<h4 class="px-2">Etat : <span class="text-success h3">Activer</span></h4>';
                                break;

                            case 'd':
                                echo '<h4 class="px-2">Etat : <span class="text-info h3">Désactiver</span></h4>';
                                break;

                            case 'r':
                                echo '<h4 class="px-2">Etat : <span class="text-danger h3">Rejeter</span></h4>';
                                break;
                            
                            case 'e':
                                echo '<h4 class="px-2">Etat : <span class="text-danger h3">Expirer</span></h4>';
                                break;

                            case 't':
                                echo '<h4 class="px-2">Etat : <span class="text-warning h3">En cours de traitement</span></h4>';
                                break;
                            
                            default:
                                echo '<h4 class="px-2">Etat : <span class="text-info h3">----</span></h4>';
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center flex-wrap w-100">
            <?php
                if($announcement["etat"] == 'd'){
                    echo '
                        <a class="btn btn-success text-white m-1" href="/activateAnnouncement?id='.$announcement["idAnn"].'">
                            Activer
                        </a>
                    ';
                }else if($announcement["etat"] == 'a'){
                    echo '
                        <a class="d-flex justify-content-center align-items-center btn btn-primary text-white p-1 m-1" href="/annoncement?id='.$announcement["idAnn"].'">
                            <span class="material-icons px-1">visibility</span>
                            Voir l\'annonce
                        </a>
                        <a class="btn btn-info text-white m-1" href="/deactivateAnnouncement?id='.$announcement["idAnn"].'">
                            Désactiver
                        </a>
                    ';
                }
            ?>
            <a class="btn btn-secondary text-white p-0 m-1" href="<?= "/modifierannonce?id=".$announcement["idAnn"] ?>">
                <span class="material-icons p-1 m-0">edit</span>
            </a>
            <a class="btn btn-danger text-white p-0 m-1" data-toggle="modal" data-target="#<?= "deleteAnn".$announcement["idAnn"] ?>">
                <span class="material-icons p-1 m-0">delete</span>
            </a>
            <div class="modal fade" id="<?= "deleteAnn".$announcement["idAnn"] ?>">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Supprimer annonce</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <p class="text-center m-0 p-0">Voulez vous supprimer l'annonce suivant ?</p>
                                <img class="miniThumbnail rounded m-1" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
                                <h5 class="text-center"><?= $announcement["titre"] ?></h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="d-flex justify-content-center align-items-center btn btn-success text-white text-nowrap m-1" href="<?= "/deleteAnnouncement?id=".$announcement["idAnn"] ?>">
                                Oui
                            </a>
                            <a class="d-flex justify-content-center align-items-center btn btn-danger text-white text-nowrap m-1" data-dismiss="modal">
                                Non
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>