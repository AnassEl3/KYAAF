<div class="result">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-between align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Résultats</h5>
                <p class="h5 text-white m-0 p-0">
                    <span class="font-weight-bold"><?= count($announcements) ?></span> 
                    résultats trouvés
                </p>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column w-100 p-2">
                <?php 
                if(count($announcements) == 0){
                    echo "Pas de résultat";
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
</div>