<?php
/*
include_once "controllers/classes/Accounts.php";
include_once "models/connection/Connection.php";

Connection::connect();
if (isset(
    $_POST['accountPrenom'],
    $_POST['accountNom'],
    $_POST['birthday'],
    $_POST['idCity'],
    $_POST['accountEmail'],
    $_POST['accountPhone'],
    $_FILES['accountAvatar']
)) {
    if (
        !empty($_POST['accountPrenom'])
        &&
        !empty($_POST['accountNom'])
        &&
        !empty($_POST['birthday'])
        &&
        !empty($_POST['idCity'])
        &&
        !empty($_POST['accountEmail'])
        &&
        !empty($_POST['accountPhone'])
    ) {
        if (
            filter_var($_POST['accountEmail'], FILTER_VALIDATE_EMAIL)
        ) {
            $goodEmail = true;
            if (
                Accounts::getUserInfo(Connection::getConn(), $_SESSION['uid'])['email'] != $_POST['accountEmail']
            ) {
                if(!Accounts::emailFree(Connection::getConn(), $_POST["accountEmail"]))
                {
                    $goodEmail = false;
                }
            }
            if($goodEmail) {
                $validPic = true;
                $imgContent = null;
                if (!empty($_FILES['accountAvatar']['name'])) {
                    $extAllowed = ['jpg', 'jpeg', 'png', 'gif', 'pjp', 'pjpeg', 'jfif'];
                    $fileExt = pathinfo($_FILES['accountAvatar']['name'], PATHINFO_EXTENSION);
                    $imgContent = addslashes(file_get_contents($_FILES['accountAvatar']['tmp_name']));
                    if (!in_array($fileExt, $extAllowed)) {
                        $validPic = false;
                    }
                }
                if ($validPic) {
                    Accounts::modifyAccount(
                        Connection::getConn(),
                        $_SESSION['uid'],
                        array(
                            'firstname' => $_POST['accountPrenom'],
                            'lastname' => $_POST['accountNom'],
                            'email' => $_POST['accountEmail'],
                            'birthday' => $_POST['birthday'],
                            'city' => $_POST['idCity'],
                            'phone_number' => $_POST['accountPhone'],
                            'profilePic' => $imgContent
                        )
                    );

                    //$_SESSION["notification"] = "modifyDone";
                    //header('location: /moncompte');
                } else {
                    $_SESSION["notification"] = "modifyFileFormatNotAllowed";
                    header('location: /moncompte');
                }
            }
            else {
                $_SESSION["notification"] = "modifyEmailUsed";
                header('location: /moncompte');
            }
        } else {
            $_SESSION["notification"] = "modifyEmailIncorrect";
            header('location: /moncompte');
        }
    } else {
        $_SESSION["notification"] = "modifyEmpty";
        header('location: /moncompte');
    }
} else {
    $_SESSION["notification"] = "modifyError";
    header('location: /moncompte');
}
*/

include_once "controllers/classes/Accounts.php";
include_once "models/connection/Connection.php";

Connection::connect();
if (isset($_POST["accountSubmit"])) {
    if (isset(
        $_POST['accountPrenom'],
        $_POST['accountNom'],
        $_POST['birthday'],
        $_POST['idCity'],
        $_POST['accountEmail'],
        $_POST['accountPhone'],
        $_FILES['accountAvatar']
    )) {
        if (
            !empty($_POST['accountPrenom'])
            &&
            !empty($_POST['accountNom'])
            &&
            !empty($_POST['birthday'])
            &&
            !empty($_POST['idCity'])
            &&
            !empty($_POST['accountEmail'])
            &&
            !empty($_POST['accountPhone'])
        ) {
            if (
                filter_var($_POST['accountEmail'], FILTER_VALIDATE_EMAIL)
            ) {
                $goodEmail = true;
                if (
                    Accounts::getUserInfo(Connection::getConn(), $_SESSION['uid'])['email'] != $_POST['accountEmail']
                ) {
                    if (!Accounts::emailFree(Connection::getConn(), $_POST["accountEmail"])) {
                        $goodEmail = false;
                    }
                }
                if ($goodEmail) {
                    $validPic = true;
                    $imgContent = null;
                    if (!empty($_FILES['accountAvatar']['name'])) {
                        $extAllowed = ['jpg', 'jpeg', 'png', 'gif', 'pjp', 'pjpeg', 'jfif'];
                        $fileExt = pathinfo($_FILES['accountAvatar']['name'], PATHINFO_EXTENSION);
                        $imgContent = file_get_contents($_FILES['accountAvatar']['tmp_name']);
                        if (!in_array($fileExt, $extAllowed)) {
                            $validPic = false;
                        }
                    }
                    if ($validPic) {
                        Accounts::modifyAccount(
                            Connection::getConn(),
                            $_SESSION['uid'],
                            array(
                                'firstname' => $_POST['accountPrenom'],
                                'lastname' => $_POST['accountNom'],
                                'email' => $_POST['accountEmail'],
                                'birthday' => $_POST['birthday'],
                                'city' => $_POST['idCity'],
                                'phone_number' => $_POST['accountPhone'],
                                'profilePic' => $imgContent
                            )
                        );
                        $_SESSION["notification"] = "modifyDone";
                        header('location: /moncompte');
                    } else {
                        $_SESSION["notification"] = "modifyFileFormatNotAllowed";
                        header('location: /moncompte');
                    }
                } else {
                    $_SESSION["notification"] = "modifyEmailUsed";
                    header('location: /moncompte');
                }
            } else {
                $_SESSION["notification"] = "modifyEmailIncorrect";
                header('location: /moncompte');
            }
        } else {
            $_SESSION["notification"] = "modifyEmpty";
            header('location: /moncompte');
        }
    } else {
        $_SESSION["notification"] = "modifyError";
        header('location: /moncompte');
    }
} elseif (isset($_POST["changePasswordSubmit"])) {
    if (
        isset(
            $_POST['password'],
            $_POST['newPassword'],
            $_POST['newPasswordConfirm']
        )
    ) {
        if (
            !empty($_POST['password'])
            &&
            !empty($_POST['newPassword'])
            &&
            !empty($_POST['newPasswordConfirm'])
        ) {
            if (Accounts::sameOldPassword(Connection::getConn(), $_SESSION['uid'], $_POST['password'])) {
                if ($_POST['newPassword'] == $_POST['newPasswordConfirm']) {
                    if (
                        preg_match("@[a-z]@", $_POST["newPassword"])
                        &&
                        preg_match("@[0-9]@", $_POST["newPassword"])
                    ) {
                        Accounts::changePassword(Connection::getConn(), $_SESSION['uid'], $_POST['newPassword']);
                        
                        $_SESSION["notification"] = "changePassDone";
                        header('location: /moncompte');
                    } else {
                        $_SESSION["notification"] = "changePassIncorrect";
                        header('location: /moncompte');
                    }
                } else {
                    $_SESSION["notification"] = "changePassConfirmIncorrect";
                    header('location: /moncompte');
                }
            } else {
                $_SESSION["notification"] = "changePassOldPassIncorrect";
                header('location: /moncompte');
            }
        } else {
            $_SESSION["notification"] = "changePassEmpty";
            header('location: /moncompte');
        }
    } else {
        $_SESSION["notification"] = "changePassError";
        header('location: /moncompte');
    }
}
