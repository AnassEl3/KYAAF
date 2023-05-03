<?php 
    include_once "controllers/classes/Info.php";
    include_once "models/entities/Villes.php";
    include_once "models/entities/Categories.php";
    include_once "models/entities/Annonces.php";
    include_once "models/entities/Photo.php";
    include_once "models/entities/Ann_photos.php";

    class Announcement{
        public static function searchAnnouncements(PDO $conn, string $search, string $categorieId, string $cityId): ?array
        {
            $sql = "SELECT * FROM annonce WHERE etat = 'a' AND titre LIKE '%".$search."%'";
            if($cityId != "0"){
                $sql .= "AND idVille = ".$cityId." ";
            }
            if($categorieId != "0"){
                $subcategories = Info::getSubcategoriesOfCategorie($conn, $categorieId);
                $subcategoriesStr = "(".$subcategories[0]->getInfos()["idCat"];
                for ($i=1; $i < count($subcategories); $i++) { 
                    $subcategoriesStr .= ",".$subcategories[$i]->getInfos()["idCat"];
                }
                $subcategoriesStr .= ")";
                $sql .= "AND idSousCat IN ".$subcategoriesStr;
            }
            $sql .= " ORDER BY dateAnn DESC";
            $request = $conn->prepare($sql);
            $request->execute();
            $announcements = $request->fetchAll(PDO::FETCH_CLASS, Annonces::class);
        
            return $announcements;
            
        }

        public static function getFirst5Ann(PDO $conn): array
        {
            $request = $conn->prepare("SELECT * FROM annonce WHERE etat = 'a' ORDER BY dateAnn DESC LIMIT 5");
            $request->execute();
            $announcements = $request->fetchAll(PDO::FETCH_CLASS, Annonces::class);

            if($announcements == null){
                return array();
            }else{
                return $announcements;
            }
        }

        public static function getAnnouncement(PDO $conn, string $annId): ?array
        {
            $request = $conn->prepare("SELECT * FROM annonce WHERE idAnn = ".$annId);
            $request->execute();
            $announcement = $request->fetchAll(PDO::FETCH_CLASS, Annonces::class);

            if($announcement == null){
                return null;
            }else{
                return $announcement[0]->getInfo();
            }
        }

        public static function getPublicAnnouncement(PDO $conn, string $annId): ?array
        {
            $request = $conn->prepare("SELECT * FROM annonce WHERE etat = 'a' AND idAnn = ".$annId);
            $request->execute();
            $announcement = $request->fetchAll(PDO::FETCH_CLASS, Annonces::class);

            if($announcement == null){
                return null;
            }else{
                return $announcement[0]->getInfo();
            }
        }

        public static function getThumbnail(PDO $conn, string $thumbnailId): array 
        {
            $request = $conn->prepare("SELECT * FROM photo WHERE idPhoto = ".$thumbnailId);
            $request->execute();
            $thumbnail = $request->fetchAll(PDO::FETCH_CLASS, Photo::class);

            if($thumbnail == null){
                $request = $conn->prepare("SELECT * FROM photo WHERE idPhoto = 2");
                $request->execute();
                $thumbnail = $request->fetchAll(PDO::FETCH_CLASS, Photo::class);
                return $thumbnail[0]->getInfo();
            }else{
                return $thumbnail[0]->getInfo();
            }
        }

        public static function getImages(PDO $conn, string $annId): array 
        {
            $request = $conn->prepare("SELECT * FROM ann_photos WHERE idAnn = ".$annId);
            $request->execute();
            $imagesId = $request->fetchAll(PDO::FETCH_CLASS, Ann_photos::class);

            $images = [];
            foreach ($imagesId as $imageId) {
                $request = $conn->prepare("SELECT * FROM photo WHERE idPhoto = ".$imageId->getInfo()["idPhoto"]);
                $request->execute();
                $img =  $request->fetchAll(PDO::FETCH_CLASS, Photo::class);
                $images[] = $img[0];
            }

            return $images;
        }

        public static function addAnnouncement(PDO $conn, array $info): bool
        {   
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //-- create the announcement
            $request = $conn->prepare(
                "INSERT INTO annonce(idVille, idCompte, idSousCat, miniature, titre, prix, etat, dateAnn, descAnn) ".
                "VALUES (:idVille, :idCompte, :idSousCat, :miniature, :titre, :prix, :etat, CURRENT_DATE, :descAnn)"
            );
            $request->execute(array(
                ':idVille' => $info['cityId'],
                ':idCompte' => $info['accountId'],
                ':idSousCat' => $info['typeId'],
                ':miniature' => "2",
                ':titre' => $info['title'],
                ':prix' => $info['price'],
                ':etat' => "t",
                ':descAnn' => $info['description'],
            ));
            $AnnouncementId = $conn->lastInsertId();

            if($AnnouncementId != 0){
            //-- setup the thumbnail
                if(isset($info["thumbnail"])){
                    $str = "INSERT INTO photo(photo) VALUE ('".$info['thumbnail']."')";
                    $conn->query($str);
                    $idPhoto = $conn->lastInsertId();
                    if($idPhoto != 0){
                        $str = "UPDATE annonce SET miniature = ".$idPhoto." WHERE annonce.idAnn = ".$AnnouncementId;
                        $conn->query($str);
                    }
                }
            
            //-- setup the images
                $imagesId = [];
                foreach ($info["images"] as $image) {
                    //************
                    $str = "INSERT INTO photo(photo) VALUE ('".$image."')";
                    $conn->query($str);
                    $idImage = $conn->lastInsertId();
                    if($idImage == 0){
                        $imagesId[] = 2;
                    }else{
                        $imagesId[] = $idImage;
                    }
                }
                foreach($imagesId as $id){
                    $str = "INSERT INTO ann_photos(idPhoto, idAnn) VALUE ('".$id."','".$AnnouncementId."')";
                    $conn->query($str);
                }

                return true;
            }else{
                return false;
            }
        }

        public static function modifyAnnouncement(PDO $conn, string $annId, array $info): bool
        {   
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //-- create the announcement
            $request = $conn->prepare(
                "UPDATE annonce SET idVille = :idVille, idCompte = :idCompte, idSousCat = :idSousCat, miniature = :miniature, titre = :titre, prix = :prix, etat = :etat, dateAnn = CURRENT_DATE, descAnn = :descAnn ".
                "WHERE idAnn = :idAnn"
            );
             
            $request->execute(array(
                ':idVille' => $info['cityId'],
                ':idCompte' => $info['accountId'],
                ':idSousCat' => $info['typeId'],
                ':miniature' => "2",
                ':titre' => $info['title'],
                ':prix' => $info['price'],
                ':etat' => "t",
                ':descAnn' => $info['description'],
                ':idAnn' => $annId
            ));

                //-- setup the thumbnail
                if(isset($info["thumbnail"])){

                    //-- delete old thumbnail
                    $image = self::getThumbnail($conn, $annId);
                    if($image["idPhoto"] != 2){
                        $str = "UPDATE annonce SET miniature = 2 WHERE annonce.idAnn = ".$annId;
                        $conn->query($str);
                        $str = "
                        SET FOREIGN_KEY_CHECKS=0;
                        DELETE FROM photo WHERE idPhoto = ".$image["idPhoto"].";
                        SET FOREIGN_KEY_CHECKS=1;
                        ";
                        $conn->query($str);
                    }
                    //************
                    $str = "INSERT INTO photo(photo) VALUE ('".$info['thumbnail']."')";
                    $conn->query($str);
                    $idPhoto = $conn->lastInsertId();
                    if($idPhoto != 0){
                        $str = "UPDATE annonce SET miniature = ".$idPhoto." WHERE annonce.idAnn = ".$annId;
                        $conn->query($str);
                    }
                }
            
                //-- delete the old images
                $request = $conn->prepare("SELECT * FROM ann_photos WHERE idAnn = ".$annId);
                $request->execute();
                $oldImages = $request->fetchAll(PDO::FETCH_CLASS, Ann_photos::class);
                foreach ($oldImages as $image) {
                    $str = "DELETE FROM ann_photos WHERE idPhoto = " . strval($image->getInfo()["idPhoto"]);
                    $conn->query($str);
                    $str = "DELETE FROM photo WHERE idPhoto = " . strval($image->getInfo()["idPhoto"]);
                    $conn->query($str);
                    
                }
                //-- setup the images
                $imagesId = [];
                foreach ($info["images"] as $image) {
                    $str = "INSERT INTO photo(photo) VALUE ('".$image."')";
                    $conn->query($str);
                    $idImage = $conn->lastInsertId();
                    if($idImage == 0){
                        $imagesId[] = 2;
                    }else{
                        $imagesId[] = $idImage;
                    }
                }
                foreach($imagesId as $id){
                    $str = "INSERT INTO ann_photos(idPhoto, idAnn) VALUE ('".$id."','".$annId."')";
                    $conn->query($str);
                }

                return true;
        }

        public static function deleteAnnouncement(PDO $conn, string $annId, string $accountId): bool
        {
            $request = $conn->prepare("SELECT * FROM `annonce` WHERE idAnn = ".$annId." AND idCompte = ".$accountId);
            $request->execute();
            $account =  $request->fetchAll(PDO::FETCH_CLASS, Compte::class);
            if(count($account) == 0){
                return false;
            }else{
                $request = $conn->prepare("
                SET FOREIGN_KEY_CHECKS=0;
                DELETE FROM photo WHERE idPhoto IN (SELECT idPhoto FROM ann_photos WHERE idAnn = ".$annId.") 
                SET FOREIGN_KEY_CHECKS=1;
                ");
                $request->execute();

                $request = $conn->prepare("
                SET FOREIGN_KEY_CHECKS=0;
                DELETE FROM favoris WHERE idAnn = ".$annId);
                $request->execute();
    
                $request = $conn->prepare("
                SET FOREIGN_KEY_CHECKS=0;
                DELETE FROM ann_photos WHERE idAnn = ".$annId);
                $request->execute();
    
                $request = $conn->prepare("
                SET FOREIGN_KEY_CHECKS=0;
                DELETE FROM annonce WHERE idAnn = ".$annId);
                $request->execute();

                return true;
            }
        }

        public static function activateAnnouncement(PDO $conn, string $annId)
        {
            $str = "UPDATE annonce SET etat = 'a' WHERE annonce.idAnn = ".$annId;
            $conn->query($str);
        }

        public static function deactivateAnnouncement(PDO $conn, string $annId)
        {
            $str = "UPDATE annonce SET etat = 'd' WHERE annonce.idAnn = ".$annId;
            $conn->query($str);
        }

    }

?>