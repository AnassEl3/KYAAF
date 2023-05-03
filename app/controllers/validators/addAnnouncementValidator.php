<?php
include_once "controllers/classes/Announcement.php";
include_once "models/connection/Connection.php";

Connection::connect();

if(isset(
    $_POST["title"],
    $_POST["categorie"],
    $_POST["type"],
    $_POST["city"],
    $_POST["description"]
)){
    if(
        !empty($_POST["title"]) 
        &&
        !empty($_POST["categorie"])
        &&
        !empty($_POST["type"]) 
        &&
        !empty($_POST["city"]) 
        &&
        !empty($_POST["description"])
    ){
    
    //thumbnail
        $validThumbnail = true;
        $thunmbnailImg = null;
        if(!empty($_FILES['thumbnail']['name']))
        {
            $extAllowed = ['jpg', 'jpeg', 'png', 'gif', 'pjp', 'pjpeg', 'jfif'];
            $fileExt = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
            $thunmbnailImg = addslashes(file_get_contents($_FILES['thumbnail']['tmp_name']));
            if(!in_array($fileExt, $extAllowed))
            {
                $validThumbnail = false;
            }
        }
        if($validThumbnail){
            $validImages = true;
            if($_FILES['addImageSelecter']['name'][0] != ""){
                foreach ($_FILES["addImageSelecter"]['name'] as $file) {
                    $extAllowed = ['jpg', 'jpeg', 'png', 'gif', 'pjp', 'pjpeg', 'jfif'];
                    $fileExt = pathinfo($file, PATHINFO_EXTENSION);
                    if(!in_array($fileExt, $extAllowed))
                    {
                        $validImages = false;
                        break;
                    }
                }
            }
            if($validImages){
                $imagesList = [];
                if($_FILES['addImageSelecter']['name'][0] != ""){
                    foreach ($_FILES["addImageSelecter"]['tmp_name'] as $file) {
                        $imagesList[] = addslashes(file_get_contents($file));
                    }
                }
                
                $added = Announcement::addAnnouncement(
                    Connection::getConn(),
                    array(
                        'title' => $_POST['title'],
                        'accountId' => $_SESSION['uid'],
                        'typeId' => $_POST['type'],
                        'cityId' => $_POST['city'],
                        'description' => $_POST['description'],
                        'price' => $_POST['price'],
                        'thumbnail' => $thunmbnailImg,
                        'images' => $imagesList
                    )
                );

                if($added){
                    $_SESSION["notification"] = "addAnnouncementDone";
                    header('location: /mesannoncements');
                }else{
                    $_SESSION["notification"] = "addAnnouncementDBError";
                    header('location: /creerannonce');
                }
            }else{
                $_SESSION["notification"] = "addAnnouncementUnvalidImages";
                header('location: /creerannonce');
            }
        }else{
            $_SESSION["notification"] = "addAnnouncementUnvalidThumbnail";
            header('location: /creerannonce');
        }
    }else{
        $_SESSION["notification"] = "addAnnouncementEmpty";
        header('location: /creerannonce');
    }
}else{
    $_SESSION["notification"] = "addAnnouncementError";
    header('location: /creerannonce');
}
