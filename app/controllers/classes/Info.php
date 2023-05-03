<?php 
    include_once "models/entities/Villes.php";
    include_once "models/entities/Categories.php";

    class Info{

    //-- Cities
        public static function getCities(PDO $conn): array
        {   
            $statement = $conn->prepare("SELECT * FROM ville");
            $statement->execute();
            $villes = $statement->fetchAll(PDO::FETCH_CLASS, Villes::class);
            return $villes;
        }
        public static function getCity(PDO $conn, string $cityId): array
        {   
            $statement = $conn->prepare("SELECT * FROM ville WHERE idVille = ".$cityId);
            $statement->execute();
            $ville = $statement->fetchAll(PDO::FETCH_CLASS, Villes::class);
            return $ville[0]->getInfos();
        }
    
    //-- Categories
        public static function getCategories(PDO $conn): array
        {   
            $statement = $conn->prepare("SELECT * FROM categorie WHERE idCatMere IS NULL");
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_CLASS, Categories::class);
            return $categories;
        }
        public static function getCategorie(PDO $conn, string $categorieId): array
        {   
            $statement = $conn->prepare("SELECT * FROM categorie WHERE idCatMere IS NULL AND idCat = ".$categorieId);
            $statement->execute();
            $categorie = $statement->fetchAll(PDO::FETCH_CLASS, Categories::class);
            return $categorie[0]->getInfos();
        }
        public static function getSubcategoriesOfCategorie(PDO $conn, string $categorieId): array
        {   
            $statement = $conn->prepare("SELECT * FROM categorie WHERE idCatMere = ".$categorieId);
            $statement->execute();
            $subcategories = $statement->fetchAll(PDO::FETCH_CLASS, Categories::class);
            return $subcategories;
        }

    //-- Subcategories
        public static function getSubCategories(PDO $conn): array
        {   
            $statement = $conn->prepare("SELECT * FROM categorie WHERE idCatMere IS NOT NULL");
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_CLASS, Categories::class);
            return $categories;
        }
        public static function getSubCategorie(PDO $conn, string $subcategorieId): array
        {   
            $statement = $conn->prepare("SELECT * FROM categorie WHERE idCatMere IS NOT NULL AND idCat = ".$subcategorieId);
            $statement->execute();
            $subCat = $statement->fetchAll(PDO::FETCH_CLASS, Categories::class);
            return $subCat[0]->getInfos();
        }
        public static function getUpperCategorie(PDO $conn, string $subcategorieId): array
        {   
            $subcategorie = self::getSubCategorie($conn, $subcategorieId);
            $uppercategorie = self::getCategorie($conn, $subcategorie["idCatMere"]);;
            return $uppercategorie;
        }

    }

?>