<?php
include_once "models/entities/Annonces.php";
include_once "models/entities/Favoris.php";

class Accounts
{
    public static function exists(PDO $conn, string $email, string $pass): ?int
    {
        $request = $conn->prepare(
            "SELECT idCompte, hashAuth ".
            "FROM auth ".
            "WHERE idCompte IN (".
            "   SELECT idCompte ".
            "   FROM compte ".
            "   WHERE email='".$email."'".
            ")"
        );
        $request->execute();
        $result = $request->fetchAll();

        if(sizeof($result) == 1)
        {
            if(password_verify($pass, $result[0]['hashAuth'])){
                return $result[0]['idCompte'];
            }
        }
        return null;
    }

    public static function emailFree(PDO $conn, string $email): bool
    {
        $request = $conn->prepare(
            "SELECT count(*) AS result ".
            "FROM compte ".
            "WHERE email='".$email."'"
        );
        $request->execute();
        $result = $request->fetchAll();
        if($result[0]['result'] == 0)
            return true;
        return false;
    }

    public static function getUserInfo(PDO $conn, string $uid): ?array
    {   
        $request = $conn->prepare("SELECT photo.photo AS avatar, idCompte, idVille, nom, prenom, sexe, tel, email, dateNaiss ".
            "FROM compte INNER JOIN photo ON photo.idphoto=compte.avatar WHERE idCompte=:idCpt");
        $request->execute(array('idCpt' => $uid));
        $userInfos = $request->fetchAll(PDO::FETCH_CLASS, Compte::class);
        if($userInfos == null){
            return null;
        }else{
            return $userInfos[0]->getInfos();
        }
        
    }

    public static function isAnnFavorite(PDO $conn, string $uid, string $annId): bool
    {   
        $request = $conn->prepare("SELECT * FROM favoris WHERE idCompte =".$uid." AND idAnn = ".$annId);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_CLASS, Favoris::class);
        if(count($result) == 0){
            return false;
        }else{
            return true;
        }
        
    }

    public static function getUserFavoritAnn(PDO $conn, string $uid): array
    {   
        $request = $conn->prepare("SELECT * FROM favoris WHERE idCompte =".$uid);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_CLASS, Favoris::class);
        return $result;
    }

    public static function favoritingAnn(PDO $conn, string $annId, string $uid): bool
    {   
        if(!self::isAnnFavorite($conn, $uid, $annId)){
            $request = $conn->prepare("INSERT INTO favoris(idCompte, idAnn) VALUES ( ".$uid.", ".$annId.")");
            $request->execute();
            return true;
        }
        return false;
    }

    public static function unfavoritingAnn(PDO $conn, string $annId, string $uid): bool
    {   
        if(self::isAnnFavorite($conn, $uid, $annId)){
            $request = $conn->prepare("DELETE FROM favoris WHERE idAnn = ".$annId." AND idCompte = ".$uid);
            $request->execute();
            return true;
        }
        return false;
    }

    public static function addUser(PDO $conn, array $info): void
    {
        if($info['profilePic'] != null)
        {
            $str = "INSERT INTO photo(photo) VALUE ('".$info['profilePic']."')";
            $conn->query($str);
            $idPhoto = $conn->lastInsertId();
            if($idPhoto == 0){
                $idPhoto = 1;
            }
        }
        else
        {
            $idPhoto = 1;
        }
        $request = $conn->prepare(
            "INSERT INTO compte(avatar, dateNaiss, email, idVille, nom, prenom, sexe, tel) ".
            "VALUES (:avatar, :dateNaiss, :email, :idVille, :nom, :prenom, :sexe, :tel)"
        );
        $request->execute(array(
            'avatar' => $idPhoto,
            'dateNaiss' => $info['birthday'],
            'email' => $info['email'],
            'idVille' => $info['idCity'],
            'nom' => $info['lastName'],
            'prenom' => $info['firstName'],
            'sexe' => $info['gender'],
            'tel' => $info['phone']
        ));
        $idCompte = $conn->lastInsertId();
        
        $request=$conn->prepare(
            "INSERT INTO auth(idCompte, hashAuth) ".
            "values (:idCompte, :hash)"
        );
        $request->execute(array(
            'idCompte' => $idCompte,
            'hash' => password_hash($info['password'], PASSWORD_DEFAULT)
        ));
    }

    public static function modifyAccount(PDO $conn, string $uid, array $info): void
    {   
        $idPhoto = 0;
        if ($info["profilePic"] != null) {
            $request = $conn->prepare("INSERT INTO photo(photo) VALUES (:picContent)");
            $request->execute(array(
                "picContent" => $info["profilePic"]
            ));

            $idPhoto = $conn->lastInsertId();

        }
        if ($idPhoto == 0) {
            $request = $conn->prepare(
                "
                UPDATE compte
                SET
                    prenom=:prenom,
                    nom=:nom,
                    dateNaiss=:dateNaiss,
                    idVille=:idVille,
                    email=:email,
                    tel=:tel
                WHERE idCompte=:idCompte
                "
            );
            $request->execute(array(
                'prenom' => $info['firstname'],
                'nom' => $info['lastname'],
                'dateNaiss' => $info['birthday'],
                'idVille' => $info['city'],
                'email' => $info['email'],
                'tel' => $info['phone_number'],
                'idCompte' => $uid
            ));
        } else {
            $oldImgId = 0;
            $getOldImgId = $conn->prepare("SELECT avatar FROM compte WHERE idCompte=:id");
            $getOldImgId->execute(array(
                "id" => $uid
            ));
            $oldImgId = $getOldImgId->fetchAll()[0]['avatar'];
            $request = $conn->prepare(
                "
                UPDATE compte
                SET
                    prenom=:prenom,
                    nom=:nom,
                    dateNaiss=:dateNaiss,
                    idVille=:idVille,
                    email=:email,
                    tel=:tel,
                    avatar=:avatar
                WHERE idCompte=:idCompte
                "
            );
            $request->execute(array(
                'prenom' => $info['firstname'],
                'nom' => $info['lastname'],
                'dateNaiss' => $info['birthday'],
                'idVille' => $info['city'],
                'email' => $info['email'],
                'tel' => $info['phone_number'],
                'avatar' => $idPhoto,
                'idCompte' => $uid
            ));
            $delPicIfNotDefault = $conn->prepare("
                DELETE FROM photo
                WHERE
                      idPhoto = :pic AND idPhoto NOT IN (0,1,2)
            ");
            $delPicIfNotDefault->execute(array(
                'pic' => $oldImgId
            ));
        }
    }

    public static function sameOldPassword(PDO $conn, $uid, $password): bool
    {
        $oldPassRequest = $conn->prepare("
            SELECT hashAuth
            FROM auth
            WHERE idCompte = :id
        ");
        $oldPassRequest->execute(array(
            "id" => $uid
        ));
        $oldHash = $oldPassRequest->fetchAll()[0]['hashAuth'];
        return password_verify($password, $oldHash);
    }

    public static function changePassword(PDO $conn, $uid, $newPassword): void
    {
        $request = $conn->prepare("UPDATE auth SET hashAuth=:newPass WHERE idCompte=:uid");
        $request->execute(array(
            'newPass' => password_hash($newPassword, PASSWORD_DEFAULT),
            'uid' => $uid
        ));
    }

    public static function getAccountAnnouncements(PDO $conn, string $uid, string $type): array
    {   
        switch ($type) {
            case 'a':
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." AND etat = 'a' ORDER BY dateAnn";
                break;

            case 'd':
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." AND etat = 'd' ORDER BY dateAnn";
                break;

            case 'r':
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." AND etat = 'r' ORDER BY dateAnn";
                break;

            case 'e':
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." AND etat = 'e' ORDER BY dateAnn";
                break;

            case 't':
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." AND etat = 't' ORDER BY dateAnn";
                break;
                
            default:
                $sql = "SELECT * FROM `annonce` WHERE idCompte = ".$uid." ORDER BY dateAnn";
                break;
        }
        $request = $conn->prepare($sql);
        $request->execute();
        $userInfos = $request->fetchAll(PDO::FETCH_CLASS, Annonces::class);

        return $userInfos;
        
    }
}

?>