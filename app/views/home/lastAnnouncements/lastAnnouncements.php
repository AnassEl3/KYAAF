<?php
    include_once "controllers/classes/Announcement.php";

    Connection::connect();

    $announcements = [];
    $announcements = Announcement::getFirst5Ann(Connection::getConn());
?>

<div class="lastAnnouncements">
    <div class="d-flex justify-content-center align-items-start flex-column p-3">
        <h2 class="px-2">Dernières annonces publiées</h2>
            <div class="d-flex justify-content-start align-items-start flex-wrap">
                <?php 
                    if(count($announcements) == 0){
                        echo "Aucun annonces trouvé";
                    }else{
                        foreach($announcements as $ann){
                            $thumbnail = Announcement::getThumbnail(Connection::getConn(), $ann->getInfo()["miniature"]);
                            echo '
                            <a class="ann d-flex justify-content-center align-items-center flex-column btn rounded p-1 m-1" href="/annoncement?id='.$ann->getInfo()["idAnn"].'">
                                <img class="thumbnail rounded" src="data:image/*;charset=utf8;base64,'.base64_encode($thumbnail['photo']).'">
                                <div class="">
                                    <h5 class="text-primary p-1">'.$ann->getInfo()["titre"].'</h5>
                                </div>
                            </a>
                            ';
                        }
                    }
                ?>
            </div>
    </div>
</div>