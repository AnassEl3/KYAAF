<?php
    include_once "controllers/classes/Announcement.php";
    include_once "controllers/classes/Accounts.php";
    include_once "controllers/classes/Info.php";

    $thumbnail = Announcement::getThumbnail(Connection::getConn(), $announcement["miniature"]);
    $announcer = Accounts::getUserInfo(Connection::getConn(), $announcement["idCompte"]);
    $categorie = Info::getUpperCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $type = Info::getSubCategorie(Connection::getConn(), $announcement["idSousCat"]);
    $city = Info::getCity(Connection::getConn(), $announcement["idVille"]);
    $images = Announcement::getImages(Connection::getConn(), $announcement["idAnn"]);
    if(isset($_SESSION["uid"])){
        $isFavorite = Accounts::isAnnFavorite(Connection::getConn(), $_SESSION["uid"], $announcement["idAnn"]);
    }else{
        $isFavorite = false;
    }
?>

<div class="announcement">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-between align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Annoncement</h5>
                <?php
                    if($isFavorite){
                        $modalName = '#unfavoritAnn'.$announcement["idAnn"];
                        echo '
                            <a class="announcementFav d-flex justify-content-start align-items-start btn btn-danger text-white p-1 m-1" data-toggle="modal" data-target="'.$modalName.'">
                                <span class="material-icons mx-1">heart_broken</span>
                                Défavorisé 
                            </a>
                        ';
                    }else{
                        $modalName = '#favoritAnn'.$announcement["idAnn"];
                        echo '
                            <a class="announcementFav d-flex justify-content-start align-items-start btn btn-info text-white p-1 m-1" data-toggle="modal" data-target="'.$modalName.'">
                                <span class="material-icons mx-1">favorite</span>
                                Favorisé 
                            </a>
                        ';
                    }

                ?>
                <div class="modal fade" id="<?= "unfavoritAnn".$announcement["idAnn"] ?>">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Défavorisation de l'annonce</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <p class="text-center m-0 p-0">Voulez vous supprimer l'annonce suivant depuis la liste des favories ?</p>
                                    <img class="thumbnail rounded m-1" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
                                    <h5 class="text-center"><?= $announcement["titre"] ?></h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="d-flex justify-content-center align-items-center btn btn-success text-white text-nowrap m-1" href="<?= "/unfavoritingAnnouncement?id=".$announcement["idAnn"] ?>">
                                    Oui
                                </a>
                                <a class="d-flex justify-content-center align-items-center btn btn-danger text-white text-nowrap m-1" data-dismiss="modal">
                                    Non
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="<?= "favoritAnn".$announcement["idAnn"] ?>">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Favorisation de l'annonce</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <p class="text-center m-0 p-0">Voulez vous ajouter l'annonce suivante à la liste des favoris ?</p>
                                    <img class="thumbnail rounded m-1" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
                                    <h5 class="text-center"><?= $announcement["titre"] ?></h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="d-flex justify-content-center align-items-center btn btn-success text-white text-nowrap m-1" href="<?= "/favoritingAnnouncement?id=".$announcement["idAnn"] ?>">
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
            <div class="d-flex justify-content-start align-items-center w-100 p-2">
                <div class="d-flex justify-content-center align-items-center flex-wrap w-100">
                    <img class="thumbnail rounded" src="data:image/*;charset=utf8;base64,<?= base64_encode($thumbnail['photo']); ?>">
                    <div class="d-flex justify-content-around align-items-start flex-column px-2">
                        <h1 class="m-0 p-0 text-primary"><?= $announcement["titre"] ?></h4>
                        <div class="d-flex justify-content-start align-items-start flex-wrap w-100">
                            <div class="d-flex justify-content-start align-items-start flex-column m-2 pr-5">
                                <div class="d-flex justify-content-center align-items-center p-1">
                                    <span class="material-icons text-muted pr-1 m-0">schedule</span> 
                                    <h5 class="m-0 p-0"><?= $announcement["dateAnn"] ?></h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-center p-1">
                                    <span class="material-icons text-muted pr-1 m-0">place</span> 
                                    <h5 class="m-0 p-0"><?= $city["nomVille"]?></h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-start flex-column m-2">
                                <h5><span class="announcementLabel text-muted text-uppercase">Catégorie :</span> <?= $categorie["nomCat"]?></h5>
                                <h5><span class="announcementLabel text-muted text-uppercase">Type :</span> <?= $type["nomCat"]?></h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center w-100">
                            <a class="announcer btn btn-primary d-flex justify-content-start align-items-center text-left text-decoration-none px-2 rounded-pill m-2" href="<?= "/annonceur?id=".$announcer["idCompte"] ?>">
                                <img class="bg-primary rounded-circle m-1 p-0" src="data:image/*;charset=utf8;base64,<?= base64_encode($announcer['avatar']); ?>">
                                <h5 class="p-0 m-0">
                                    <span class="announcementLabel text-uppercase">Annonceur :</span> 
                                    <br> 
                                    <span class="text-capitalize"><?= $announcer["nom"] . " " . $announcer["prenom"] ?></span>
                                </h5>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="details d-flex justify-content-start align-items-start flex-column w-100 p-2">
                <div class="detailsHead bg-primary w-100 p-0 pt-3 rounded-top">
                    <a class="descriptionBtn text-decoration-none m-0 mx-1 p-1 rounded-top h5 selected" data-info="description">
                        <span class="material-icons">description</span>
                        Description
                    </a>
                    <a class="priceBtn text-decoration-none m-0 mx-1 p-1 rounded-top h5" data-info="price">
                        <span class="material-icons">payments</span>
                        prix
                    </a>
                    <a class="contactBtn text-decoration-none m-0 mx-1 p-1 rounded-top h5" data-info="contact">
                        <span class="material-icons">contact_mail</span>    
                        Contact
                    </a>
                </div>
                <div class="detailsBody w-100 p-1 rounded-bottom">
                    <div class="info description justify-content-center align-items-center m-2 rounded">
                        <textarea class="form-control bg-white m-0 p-0 w-100" readonly><?= $announcement["descAnn"] ?></textarea>
                    </div>
                    <div class="info price justify-content-center align-items-center m-2 rounded hidden">
                        <h1 class="text-center text-primary p-5 w-100">
                            <?= $announcement["prix"] ?>
                            DH
                        </h1>
                    </div>
                    <div class="info contact justify-content-center align-items-center hidden">
                        <div class="contactContainer d-flex justify-content-center align-items-center flex-column w-auto m-1 p-2 rounded">
                            <span class="material-icons text-primary">call</span>
                            <h4><?= $announcer["telephone"] ?></h4>
                        </div>
                        <div class="contactContainer d-flex justify-content-center align-items-center flex-column w-auto m-1 p-2 rounded">
                            <span class="material-icons text-primary">email</span>
                            <h4><?= $announcer["email"] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if(count($images) != 0):
            ?>
            <div id="announcementImagesCarousel" class="carousel slide rounded m-2 w-75" data-ride="carousel">
                <ol class="carousel-indicators">
                <?php
                    foreach ($images as $key => $val):
                ?>
                    <li data-target="#announcementImagesCarousel" data-slide-to="<?= $key ?>" <?php if($key == 0){echo 'class="active"';} ?>></li>
                <?php
                    endforeach;
                ?>
                </ol>
                <div class="carousel-inner">
                <?php
                    foreach ($images as $key => $val):
                ?>
                    <div class="carousel-item <?php if($key == 0){echo "active";} ?>">
                        <div class="container-fluid">
                            <a class="" href="#" data-toggle="modal" data-target="#announcementCarouselImage<?= $key?>">
                                <img class="announcementCarouselImage d-block img-fluid" src="data:image/*;charset=utf8;base64,<?= base64_encode($val->getInfo()["photo"]); ?>">
                            </a>
                            <div class="modal fade" id="announcementCarouselImage<?= $key?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span class="text-white" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                            <img class="img-fluid" src="data:image/*;charset=utf8;base64,<?= base64_encode($val->getInfo()["photo"]); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
                </div>
                <a class="carousel-control-prev rounded-left bg-primary" href="#announcementImagesCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next rounded-right bg-primary" href="#announcementImagesCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
</div>