<?php
    include_once "controllers/classes/Announcement.php";

    Connection::connect();

    if(!isset($_GET["id"])){
        header("Location: /404");
    }else{
        $announcement = Announcement::getAnnouncement(
            Connection::getConn(), 
            $_GET["id"]
        );
    }

    if($announcement == null || $announcement["etat"] != "a"){
        header("Location: /404");
    }
?>

<?php include "views/shared/htmlHead/htmlHead.php";?>

<?php include "views/shared/navigation/navigation.php";?>
<?php include "views/announcement/announcementModal/announcementModal.php";?>
<?php include "views/shared/footer/footer.php";?>

<?php include "views/shared/htmlFeet/htmlFeet.php";?>