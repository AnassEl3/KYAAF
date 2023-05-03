<?php
    include_once "controllers/classes/Accounts.php";

    Connection::connect();

    /*
    tt: All
    a: Activated
    d: deactivated
    t: being processed
    e: Expired
    */
    if(!isset($_GET["type"])){
        $type = "tt";
    }else{
        $type = $_GET["type"];
    }

    $announcements = Accounts::getAccountAnnouncements(
        Connection::getConn(),
        $_SESSION["uid"],
        $type
    );

?>

<div class="myAnnouncements">
    <div class="container rounded bg-white p-0 my-2">
        <div class="d-flex justify-content-center align-items-center flex-column">
            <div class="d-flex justify-content-start align-items-center rounded-top w-100 bg-primary p-1">
                <h5 class="text-white text-uppercase">Mes annonces</h5>
            </div>
            <div class="d-flex justify-content-between align-items-center w-100 p-2">
                <form class="d-flex justify-content-between align-items-center mx-3 w-100" method="get" action="/mesannoncements">
                    <h5 class="text-nowrap">Etat :</h5>
                    <div class="d-flex justify-content-start align-items-center flex-wrap">
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="tt"  <?php if($type == "tt" || !isset($_GET["type"])){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1">Tout</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="a" <?php if($type == "a"){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1">Activer</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="d" <?php if($type == "d"){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1">Désactiver</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="r" <?php if($type == "r"){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1">Rejeter</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="e" <?php if($type == "e"){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1">Expirer</p>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mx-2">
                            <input class="btn" type="radio" name="type" value="t" <?php if($type == "t"){ echo "checked";} ?>>
                            <p class="p-0 m-0 mx-1 text-nowrap">En cours de traitement</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center">
                        <button class="btn btn-primary rounded-circle p-0" type="submit">
                            <span class="material-icons rounded-circle bg-primary text-white p-2">autorenew</span>
                        </button>
                    </div>
                </form>
                
            </div>
            <div class="d-flex justify-content-around align-items-center flex-column py-2 w-100">
                
                <?php 
                if(count($announcements) == 0){
                    echo "Aucune d'annonces trouvé";
                }else{
                    foreach($announcements as $ann){
                        $announcement = $ann->getInfo();
                        include "views/myAnnouncements/miniMyAnnouncement/miniMyAnnouncement.php";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>