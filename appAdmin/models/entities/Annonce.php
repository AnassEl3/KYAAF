<?php

class Annonce
{
    private int $idAnn;
    private int $idVille;
    private string $nomVille;
    private int $idCompte;
    private int $idSousCat;
    private string $nomCat;
    private int $miniature;
    private string $photo;
    private string $titre;
    private float $prix;
    private string $etat;
    private string $dateAnn;
    private int $ageAnn;
    private string $descAnn;
    private int $idAdmin;
    private string $priority;

    /**
     * @return int
     */
    public function getIdAnn(): int
    {
        return $this->idAnn;
    }

    /**
     * @return int
     */
    public function getIdVille(): int
    {
        return $this->idVille;
    }

    /**
     * @return string
     */
    public function getNomVille(): string
    {
        return $this->nomVille;
    }

    /**
     * @return int
     */
    public function getIdCompte(): int
    {
        return $this->idCompte;
    }

    /**
     * @return int
     */
    public function getIdSousCat(): int
    {
        return $this->idSousCat;
    }

    /**
     * @return string
     */
    public function getNomCat(): string
    {
        return $this->nomCat;
    }

    /**
     * @return int
     */
    public function getMiniature(): int
    {
        return $this->miniature;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

    /**
     * @return string
     */
    public function getDateAnn(): string
    {
        return $this->dateAnn;
    }

    /**
     * @return int
     */
    public function getAgeAnn(): int
    {
        return $this->ageAnn;
    }

    /**
     * @return string
     */
    public function getDescAnn(): string
    {
        return $this->descAnn;
    }

    /**
     * @return int
     */
    public function getIdAdmin(): int
    {
        return $this->idAdmin;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    public static function getAnnonce(PDO $conn, string $idAnn): ?Annonce
    {
        $request = $conn->prepare(
            "SELECT
                a.idAnn,
                a.idVille,
                v.nomVille,
                a.idCompte,
                a.idSousCat,
                c.nomCat,
                a.miniature,
                p.photo,    
                a.titre,
                a.prix,
                a.etat,
                a.dateAnn,
                ABS(DATEDIFF(CURDATE(), a.dateAnn)) AS ageAnn,
                a.descAnn
            FROM
                annonce a
                INNER JOIN
                ville v
                ON a.idVille = v.idVille
                INNER JOIN
                photo p
                ON a.miniature = p.idPhoto
                INNER JOIN
                categorie c
                ON a.idSousCat = c.idCat
            WHERE a.idAnn = :idAnn
        ");
        $request->execute(array(
            'idAnn' => $idAnn
        ));
        $res = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        if (sizeof($res) == 1) {
            return $res[0];
        }
        return null;
    }

    public static function getAdminOnlineAnnonce(PDO $conn, string $idAnn, string $idAdmin): ?Annonce
    {
        $request = $conn->prepare("
            SELECT
                a.idAnn,
                a.idVille,
                v.nomVille,
                a.idCompte,
                a.idSousCat,
                c.nomCat,
                a.miniature,
                p.photo,    
                a.titre,
                a.prix,
                a.etat,
                a.dateAnn,
                ABS(DATEDIFF(CURDATE(), a.dateAnn)) AS ageAnn,
                a.descAnn
            FROM
                annonce a
                INNER JOIN
                ville v
                ON a.idVille = v.idVille
                INNER JOIN
                photo p
                ON a.miniature = p.idPhoto
                INNER JOIN
                categorie c
                ON a.idSousCat = c.idCat
            WHERE
                a.idAnn = :idAnn
                AND
                a.etat IN ('a','d')
                AND
                a.idAdmin = :idAdmin
        ");
        $request->execute(array(
            'idAnn' => $idAnn,
            'idAdmin' => $idAdmin
        ));
        $res = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        if (sizeof($res) == 1) {
            return $res[0];
        }
        return null;
    }

    public static function getAdminOnlineAnnonces(PDO $conn, string $idAdmin): array
    {
        $request = $conn->prepare("
            SELECT
                idAnn,
                descAnn,
                etat,
                ABS(DATEDIFF(CURDATE(), dateAnn)) AS ageAnn
            FROM annonce
            WHERE
                etat IN ('a', 'd')  
                AND
                idAdmin = :idAdmin
            ORDER BY dateAnn DESC
        ");
        $request->execute(array(
            'idAdmin' => $idAdmin
        ));
        $res = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        return $res;
    }

    public static function getPendingAnnonces(PDO $conn): array
    {
        // FOR HIGH SEVERITY PENDING POSTS
        $request = $conn->prepare("
            SELECT
                a.idAnn,
                a.idVille,
                v.nomVille,
                a.idCompte,
                a.idSousCat,
                c.nomCat,
                a.miniature,
                p.photo,    
                a.titre,
                a.prix,
                a.etat,
                a.dateAnn,
                ABS(DATEDIFF(CURDATE(), a.dateAnn)) AS ageAnn,
                a.descAnn,
                'critical' AS priority
            FROM
                annonce a
                INNER JOIN
                ville v
                ON a.idVille = v.idVille
                INNER JOIN
                photo p
                ON a.miniature = p.idPhoto
                INNER JOIN
                categorie c
                ON a.idSousCat = c.idCat
            WHERE
                a.etat = 't'
                AND
                DATEDIFF(CURDATE(), a.dateAnn) > 10
            ORDER BY a.dateAnn
        ");
        $request->execute();
        $critical = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        // FOR MEDIUM SEVERITY PENDING POSTS
        $request = $conn->prepare("
            SELECT
                a.idAnn,
                a.idVille,
                v.nomVille,
                a.idCompte,
                a.idSousCat,
                c.nomCat,
                a.miniature,
                p.photo,    
                a.titre,
                a.prix,
                a.etat,
                a.dateAnn,
                ABS(DATEDIFF(CURDATE(), a.dateAnn)) AS ageAnn,
                a.descAnn,
                'warning' AS priority
            FROM
                annonce a
                INNER JOIN
                ville v
                ON a.idVille = v.idVille
                INNER JOIN
                photo p
                ON a.miniature = p.idPhoto
                INNER JOIN
                categorie c
                ON a.idSousCat = c.idCat
            WHERE
                a.etat = 't'
                AND
                DATEDIFF(CURDATE(), a.dateAnn) > 5
                AND
                DATEDIFF(CURDATE(), a.dateAnn) <= 10
            ORDER BY a.dateAnn
        ");
        $request->execute();
        $warning = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        // FOR MINIMUM SEVERITY PENDING POSTS
        $request = $conn->prepare("
            SELECT
                a.idAnn,
                a.idVille,
                v.nomVille,
                a.idCompte,
                a.idSousCat,
                c.nomCat,
                a.miniature,
                p.photo,    
                a.titre,
                a.prix,
                a.etat,
                a.dateAnn,
                ABS(DATEDIFF(CURDATE(), a.dateAnn)) AS ageAnn,
                a.descAnn,
                'ok' AS priority
            FROM
                annonce a
                INNER JOIN
                ville v
                ON a.idVille = v.idVille
                INNER JOIN
                photo p
                ON a.miniature = p.idPhoto
                INNER JOIN
                categorie c
                ON a.idSousCat = c.idCat
            WHERE
                a.etat = 't'
                AND
                DATEDIFF(CURDATE(), a.dateAnn) <= 5
            ORDER BY a.dateAnn
        ");
        $request->execute();
        $good = $request->fetchAll(PDO::FETCH_CLASS, self::class);

        return array(
            'critical' => $critical,
            'warning' => $warning,
            'good' => $good
        );
    }

    public static function getExpiredAnnonces(PDO $conn): array
    {
        $request = $conn->prepare("
            SELECT
                idAnn,
                descAnn,
                ABS(DATEDIFF(CURDATE(), dateAnn)) AS ageAnn
            FROM annonce
            WHERE
                etat = 'e'
            ORDER BY dateAnn ASC
        ");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_CLASS, Annonce::class);
    }

    public static function getNbrPendingAnnonces(PDO $conn): int
    {
        $request = $conn->prepare("SELECT COUNT(*) AS nbr FROM annonce WHERE etat = 't'");
        $request->execute();
        return $request->fetchAll()[0]['nbr'];
    }

    public static function getNbrValidAnnonces(PDO $conn): int
    {
        $request = $conn->prepare("SELECT COUNT(*) AS nbr FROM annonce WHERE etat IN ('a','d')");
        $request->execute();
        return $request->fetchAll()[0]['nbr'];
    }

    public static function getNbrOnlineAnnonces(PDO $conn): int
    {
        $request = $conn->prepare("SELECT COUNT(*) AS nbr FROM annonce WHERE etat IN ('a')");
        $request->execute();
        return $request->fetchAll()[0]['nbr'];
    }

    public static function getNbrDeniedAnnonces(PDO $conn): int
    {
        $request = $conn->prepare("SELECT COUNT(*) AS nbr FROM annonce WHERE etat = 'r'");
        $request->execute();
        return $request->fetchAll()[0]['nbr'];
    }

    public static function getNbrExpiredAnnonces(PDO $conn): int
    {
        $request = $conn->prepare("SELECT COUNT(*) AS nbr FROM annonce WHERE etat = 'e'");
        $request->execute();
        return $request->fetchAll()[0]['nbr'];
    }

    public static function grantAnnonce(PDO $conn, string $idAnn, string $idAdmin)
    {
        try {
            $request = $conn->prepare("UPDATE annonce SET etat='a', dateAnn=CURDATE(), idAdmin=:idAdmin WHERE idAnn=:id AND etat='t'");
            $request->execute(array(
                'id' => $idAnn,
                'idAdmin' => $idAdmin
            ));
            if ($request->rowCount() == 0) {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw $e;
        }
        return null;
    }

    public static function denyAnnonce(PDO $conn, string $idAnn, string $idAdmin)
    {
        try {
            $request = $conn->prepare("UPDATE annonce SET etat='r', dateAnn=CURDATE(), idAdmin=:idAdmin WHERE idAnn=:id AND etat='t'");
            $request->execute(array(
                'id' => $idAnn,
                'idAdmin' => $idAdmin
            ));
            if ($request->rowCount() == 0) {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw $e;
        }
        return null;
    }

    public static function denyAnnonceOnline(PDO $conn, string $idAnn, string $idAdmin)
    {
        try {
            $request = $conn->prepare("UPDATE annonce SET etat='r', dateAnn=CURDATE() WHERE idAnn=:id AND etat IN ('a','d') AND idAdmin=:idAdmin");
            $request->execute(array(
                'id' => $idAnn,
                'idAdmin' => $idAdmin
            ));
            if ($request->rowCount() == 0) {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw $e;
        }
        return null;
    }

    public static function archiveAnnonce(PDO $conn): void
    {
        $request = $conn->prepare("UPDATE annonce SET etat='e', dateAnn=CURDATE() WHERE ABS(DATEDIFF(CURDATE(), dateAnn)) > 30 AND etat NOT IN ('e','r')");
        $request->execute();
    }

    public static function deleteAnnonce(PDO $conn): void
    {
        //Relationship Table
        $request = $conn->prepare("
           DELETE FROM ann_photos
           WHERE idAnn IN (
               SELECT idAnn
               FROM annonce
               WHERE ABS(DATEDIFF(CURDATE(), annonce.dateAnn)) > 30
           )
        ");
        $request->execute();
        //Annonces
        $request = $conn->prepare("
            DELETE FROM annonce
            WHERE ABS(DATEDIFF(CURDATE(), dateAnn)) > 30
        ");
        $request->execute();

        //Photos
        $request = $conn->prepare("
            DELETE FROM photo
            WHERE
                idPhoto NOT IN (
                    SELECT idPhoto
                    FROM ann_photos
                )
                AND
                idPhoto NOT IN (
                    SELECT miniature
                    FROM annonce
                )
                AND 
                idPhoto NOT IN (
                    SELECT avatar
                    FROM compte
                )
                AND
                idPhoto NOT IN (
                    SELECT idPhoto
                    FROM infos
                )
                AND
                idPhoto NOT IN (1,2)
        ");
        $request->execute();
    }
}