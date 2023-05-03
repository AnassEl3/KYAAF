<?php
include_once "controllers/classes/Accounts.php";
include_once "models/connection/Connection.php";

Connection::connect();
if(isset(
    $_POST['firstName'],
    $_POST['lastName'],
    $_POST['gender'],
    $_POST['birthday'],
    $_POST['idCity'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['password'],
    $_POST['passwordConfirm'],
    $_POST['submit']
)){
    if(
        !empty($_POST['firstName'])
        &&
        !empty($_POST['lastName'])
        &&
        !empty($_POST['gender'])
        &&
        !empty($_POST['birthday'])
        &&
        !empty($_POST['idCity'])
        &&
        !empty($_POST['email'])
        &&
        !empty($_POST['phone'])
        &&
        !empty($_POST['password'])
        &&
        !empty($_POST['passwordConfirm'])
    ){
        if(
            filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
            &&
            (
                preg_match("@[a-z]@", $_POST['password'])
                &&
                preg_match("@[0-9]@", $_POST['password'])
            )
        ){
            if($_POST['password'] == $_POST['passwordConfirm'])
            {
                if(Accounts::emailFree(Connection::getConn(), $_POST['email']))
                {
                    $validPic = true;
                    $imgContent = null;
                    if(!empty($_FILES['profilePic']['name']))
                    {
                        $extAllowed = ['jpg', 'jpeg', 'png', 'gif', 'pjp', 'pjpeg', 'jfif'];
                        $fileExt = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
                        $imgContent = addslashes(file_get_contents($_FILES['profilePic']['tmp_name']));
                        if(!in_array($fileExt, $extAllowed))
                        {
                            $validPic = false;
                        }
                    }
                    if($validPic)
                    {
                        Accounts::addUser(
                            Connection::getConn(),
                            array(
                                'firstName' => $_POST['firstName'],
                                'lastName' => $_POST['lastName'],
                                'gender' => $_POST['gender'],
                                'email' => $_POST['email'],
                                'birthday' => $_POST['birthday'],
                                'idCity' => $_POST['idCity'],
                                'phone' => $_POST['phone'],
                                'password' => $_POST['password'],
                                'profilePic' => $imgContent
                            )
                        );
                        
                        $_SESSION["notification"] = "signinDone";
                        header('location: /');
                    }
                    else{
                        $_SESSION["notification"] = "signinFileFormatNotAllowed";
                        header('location: /inscription');
                    }
                }
                else
                {
                    $_SESSION["notification"] = "signinEmailUsed";
                    header('location: /inscription');
                }
            }
            else
            {
                $_SESSION["notification"] = "signinPasswordConfirmIncorrect";
                header('location: /inscription');
            }
        }
        else
        {
            $_SESSION["notification"] = "signinEmailPasswordIncorrect";
            header('location: /inscription');
        }
    }
    else
    {
        $_SESSION["notification"] = "signinEmpty";
        header('location: /inscription');
    }
}
else
{
    $_SESSION["notification"] = "signinError";
    header('location: /inscription');
}