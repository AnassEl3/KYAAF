<?php
    include_once 'models/connection/Connection.php';
    include_once 'controllers/classes/Accounts.php';
    include_once 'controllers/classes/Info.php';
    include_once 'models/entities/Compte.php';

    Connection::connect();
    $conn = Connection::getConn();

    $cities = Info::getCities($conn);
    $categories = Info::getCategories($conn);
    $subCategories = Info::getSubCategories($conn);

    if(isset($_SESSION["uid"])){
        $accountInfos = Accounts::getUserInfo($conn, $_SESSION["uid"]);
    }

    //-- Public pages ------------------------------------------------------------------------------------------------
    if($page == "/"){

        header("Location: /accueil");

    }else if($page == "/accueil"){

        require 'views/home/home.php'; 

    }else if($page == "/recherche"){

        require 'views/search/search.php'; 

    }else if($page == "/inscription"){

        require 'views/registration/registration.php';

    }else if($page == "/annoncement"){

        require 'views/announcement/announcement.php';

    }else if($page == "/annonceur"){

        require 'views/announcer/announcer.php';

    }else if(isset($_SESSION["uid"])){

    //-- Private pages ------------------------------------------------------------------------------------------------
        if(!isset($accountInfos)){

            header("Location: /deconnect");
            
        }else{
            if($page == "/monannoncement"){

                require 'views/myAnnouncement/myAnnouncement.php'; 
            
            }else if($page == "/mesannoncements"){
        
                require 'views/myAnnouncements/myAnnouncements.php'; 
            
            }else if($page == "/favories"){
        
                require 'views/favorites/favorites.php'; 
        
            }else if($page == "/moncompte"){
                
                require 'views/myAccount/myAccount.php'; 
        
            }else if($page == "/creerannonce"){
        
                require 'views/addAnnouncement/addAnnouncement.php'; 
        
            }else if($page == "/modifierannonce"){
        
                require 'views/modifyAnnouncement/modifyAnnouncement.php'; 
        
            }else{
        
                require 'views/404/404.php';
        
            }
        }
    }else{
        require 'views/404/404.php';
    }
?>