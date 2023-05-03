<?php
    include_once "controllers/classes/Accounts.php";
    include_once "controllers/classes/Announcement.php";

    Connection::connect();

    if(!isset($_GET["id"])){
        include "views/404/404.php";
        exit();
    }

    $idAnnouncer = $_GET["id"];
    $announcer = Accounts::getUserInfo(Connection::getConn(), $idAnnouncer);
   
    if($announcer == null){
        include "views/404/404.php";
        exit();
    }
    
    $announcements = Accounts::getAccountAnnouncements(
        Connection::getConn(),
        $idAnnouncer,
        "a"
    );
    
?>

<?php include "views/shared/htmlHead/htmlHead.php";?>

<?php include "views/shared/navigation/navigation.php";?>
<?php include "views/announcer/announcerInfo/announcerInfo.php";?>
<?php include "views/announcer/listeAnnoncements/listeAnnouncements.php";?>
<?php include "views/shared/footer/footer.php";?>

<?php include "views/shared/htmlFeet/htmlFeet.php";?>