<div class="listAnouncements">
    <div class="container rounded bg-white p-0 mb-2">
        <div class="d-flex justify-content-between align-items-center rounded-top w-100 bg-primary p-1">
            <h5 class="text-white text-uppercase">Annonces</h5>
        </div>
        <div class="d-flex justify-content-around align-items-center flex-column p-2 w-100">
            <?php 
                if(count($announcements) == 0){
                    echo "Aucune annonce pour le moment.";
                }else{
                    foreach($announcements as $ann){
                        $announcement = $ann->getInfo();
                        include realpath($_SERVER["DOCUMENT_ROOT"]) . "/views/shared/miniAnnouncement/miniAnnouncement.php";
                    }
                }
            ?>

        </div>
    </div>
</div>