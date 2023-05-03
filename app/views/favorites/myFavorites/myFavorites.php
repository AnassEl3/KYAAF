<?php
    include_once "controllers/classes/Accounts.php";
    include_once "controllers/classes/Announcement.php";
    include_once "models/entities/Favoris.php";
    include_once "models/entities/Annonces.php";

    Connection::connect();

    $favoritsList = Accounts::getUserFavoritAnn(
        Connection::getConn(),
        $_SESSION["uid"]
    );

    $announcements = [];
    foreach ($favoritsList as $favorit) {
        $ann = Announcement::getPublicAnnouncement(
            Connection::getConn(),
            $favorit->getInfo()["idAnn"]
        );
        if($ann != null){
            $announcements[] = $ann;
        }

    }

?>
<div class="favorites">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-start align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Favories</h5>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column w-100 p-2">
                <?php 
                    if(count($announcements) == 0){
                        echo "Vous avez aucune annonce favoriser.";
                    }else{
                        foreach ($announcements as $announcement) {
                            include realpath($_SERVER["DOCUMENT_ROOT"]) . "/views/shared/miniAnnouncement/miniAnnouncement.php";
                        }
                    }
                
                ?>
            </div>
        </div>
    </div>
</div>