<?php
    include_once "controllers/classes/Announcement.php";

    Connection::connect();

    $announcements = [];
    if(isset($_GET['r']) && isset($_GET['c']) && isset($_GET['v'])){
        $announcements = Announcement::searchAnnouncements(
            Connection::getConn(), 
            $_GET['r'],
            $_GET['c'],
            $_GET['v']
        );   
    }else{
        header('Location: /recherche?r=&c=0&v=0');
    }
?>

<?php include "views/shared/htmlHead/htmlHead.php";?>

<?php include "views/shared/navigation/navigation.php";?>
<?php include "views/search/searchBar/searchBar.php";?>
<?php include "views/search/result/result.php";?>
<?php include "views/shared/footer/footer.php";?>

<?php include "views/shared/htmlFeet/htmlFeet.php";?>