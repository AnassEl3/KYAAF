<?php
include_once 'models/connection/Connection.php';
include_once 'models/entities/Compte.php';
include_once 'models/entities/Annonce.php';

Connection::connect();
Annonce::archiveAnnonce(Connection::getConn());
Annonce::deleteAnnonce(Connection::getConn());


$matches = array();
preg_match("~(/)?\K([a-zA-Z-]+)(/)?\K([0-9]+)?~", $page, $matches);

$accountInfos = null;
if (isset($_SESSION["uid"])) {
    $accountInfos = Compte::getUser(Connection::getConn(), $_SESSION['uid']);
}
if (sizeof($matches) <= 2) {
    header("Location: /connexion");
} elseif (sizeof($matches) <= 4 && $matches[1] == "/") {
    switch ($matches[2]) {
        case 'connexion' :
            require 'views/login/login.php';
            break;
        case 'dashboard' :
            if ($accountInfos != null)
                require 'views/dashboard/dashboard.php';
            else
                header('location: /');
            break;
        case 'gestion-annonce' :
            if ($accountInfos != null)
                require 'views/gestion/gestion.php';
            else
                header('location: /');
            break;
        case 'gestion-annonce-en-ligne' :
            if ($accountInfos != null)
                require 'views/online-gestion/gestion.php';
            else
                header('location: /');
            break;
        case 'annonce-expiree' :
            if ($accountInfos != null)
                require 'views/expired/expired-view.php';
            else
                header('location: /');
            break;

        case 'login-val' :
            require 'controllers/validators/loginValidator.php';
            break;
        case 'disconnect' :
            session_destroy();
            header('location: /');
            break;
        case 'not-found' :
            require 'views/404/notfound.php';
            break;
        default :
            header('location:/not-found');
    }
} elseif (sizeof($matches) <= 6 && $matches[1] == '/' && $matches[3] == '/') {
    if($accountInfos != null)
    {
        switch ($matches[2]) {
            case 'grant-annonce':
                $idAnn = $matches[4];
                require 'controllers/tasks/grantAnnonce.php';
                break;
            case 'deny-annonce':
                $idAnn = $matches[4];
                require 'controllers/tasks/denyAnnonce.php';
                break;
            case 'deny-annonce-en-ligne':
                $idAnn = $matches[4];
                require 'controllers/tasks/denyAnnonceOnline.php';
                break;
            case 'gestion-annonce':
                $idAnn = $matches[4];
                require 'views/gestion/visualization.php';
                break;
            case 'gestion-annonce-en-ligne':
                $idAnn = $matches[4];
                require 'views/online-gestion/visualization.php';
                break;
        }
    }
    else
    {
        header('/not-found');
    }

}