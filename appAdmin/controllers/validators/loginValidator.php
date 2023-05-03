<?php

include_once "models/entities/Compte.php";
include_once "models/connection/Connection.php";

Connection::connect();
if(isset($_POST['email'], $_POST['password'], $_POST['submit']))
{
    if(!empty($_POST['email']) && !empty($_POST['password']))
    {
        $idUser = Compte::exists(Connection::getConn(), $_POST['email'], $_POST['password']);
        if($idUser != null)
        {
            $_SESSION["uid"] = $idUser;
            header('Location:/dashboard');
        }
        else
        {
            $_SESSION["notification"] = "loginIncorrect";
            header('Location:/connexion');
        }
    }else{
        $_SESSION["notification"] = "loginEmpty";
        header('Location:/connexion');
    }
}else{
    $_SESSION["notification"] = "loginError";
    header('Location:/connexion');
}