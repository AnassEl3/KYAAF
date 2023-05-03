<?php
    if($page == "/login"){
        
        include_once "controllers/validators/loginValidator.php";

    }else if($page == "/signin"){        

        include_once "controllers/validators/signupValidator.php";

    }else if($page == "/deconnect"){

        unset($_SESSION['uid']);
        header("Location: /accueil"); 

    }else if($page == "/modifyAccount"){
        /*
        if(isset($_FILES["accountAvatar"]["name"])){
            echo "Avatar: " . $_FILES["accountAvatar"]["name"];
        }
        
        echo "nom: " . $_POST["accountNom"];
        echo "prenom: " . $_POST["accountPrenom"];
        echo "dateNaissance: " . $_POST["birthday"];
        echo "Ville: " . $_POST["idCity"];
        echo "Email: " . $_POST["accountEmail"];
        echo "Tele: " . $_POST["accountPhone"];
        echo "Submit: " . $_POST["accountSubmit"];
        */
        include_once "controllers/validators/modifyAccountValidator.php";
        
    }else if($page == "/changeAccountPassword"){

        echo "Password: " . $_POST["password"];
        echo "NewPassword: " . $_POST["newPassword"];
        echo "ConfirmNewPassword" . $_POST["newPasswordConfirm"];
        echo "changePasswordSubmit" . $_POST["changePasswordSubmit"];

    }else if($page == "/addAnnouncement"){
        
        include_once "controllers/validators/addAnnouncementValidator.php";

    }else if($page == "/modifyAnnouncement"){
        
        include_once "controllers/validators/modifyAnnouncementValidator.php";

    }else if($page == "/deleteAnnouncement"){
        
        include_once "controllers/classes/Announcement.php";
        include_once "models/connection/Connection.php";
        Connection::connect();
        $result = Announcement::deleteAnnouncement(
            Connection::getConn(),
            $_GET["id"],
            $_SESSION["uid"]
        );

        if($result){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            header('Location: /404');
        }
        
    }else if($page == "/activateAnnouncement"){

        include_once "controllers/classes/Announcement.php";
        include_once "models/connection/Connection.php";
        Connection::connect();
        Announcement::activateAnnouncement($conn, $_GET["id"],);
        header("Location: /mesannoncements");

    }else if($page == "/deactivateAnnouncement"){

        include_once "controllers/classes/Announcement.php";
        include_once "models/connection/Connection.php";
        Connection::connect();
        Announcement::deactivateAnnouncement($conn, $_GET["id"],);
        header("Location: /mesannoncements");
        
    }else if($page == "/favoritingAnnouncement"){
        
        if(isset($_SESSION["uid"])){
            include_once "controllers/classes/Announcement.php";
            include_once "models/connection/Connection.php";
            Connection::connect();

            $result = Accounts::favoritingAnn(
                Connection::getConn(),
                $_GET["id"],
                $_SESSION["uid"]
            );

            if($result){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                header('Location: /404');
            }
        }else{
            $_SESSION["notification"] = "notLogged";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        
    }else if($page == "/unfavoritingAnnouncement"){
        if(isset($_SESSION["uid"])){
            include_once "controllers/classes/Announcement.php";
            include_once "models/connection/Connection.php";
            Connection::connect();

            $result = Accounts::unfavoritingAnn(
                Connection::getConn(),
                $_GET["id"],
                $_SESSION["uid"]
            );
            
            if($result){
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                header('Location: /404');
            }
        }else{
            $_SESSION["notification"] = "notLogged";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>