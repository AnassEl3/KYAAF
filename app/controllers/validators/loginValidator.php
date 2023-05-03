<?php

include_once "controllers/classes/Accounts.php";
include_once "models/connection/Connection.php";

Connection::connect();

if(isset($_POST['email'], $_POST['password'], $_POST['submit']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $idUser = Accounts::exists(Connection::getConn(), $_POST['email'], $_POST['password']);
        if($idUser != null)
        {
            if(isset($_POST['remember_me'])) {
                setcookie('idUser', $idUser);
            }
            
            $_SESSION["uid"] = $idUser;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else
        {
            $_SESSION["notification"] = "loginIncorrect";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }else{
        $_SESSION["notification"] = "loginEmpty";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}else{
    $_SESSION["notification"] = "loginError";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
}