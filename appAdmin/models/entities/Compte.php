<?php

class Compte
{
    private string $idCompte;
    private int $idVille;
    private string $nomVille;
    private int $avatar;
    private string $photo;
    private string $tel;
    private string $nom;
    private string $prenom;
    private string $sexe;
    private string $email;
    private string $dateNaiss;

    /**
     * @return string
     */
    public function getIdCompte(): string
    {
        return $this->idCompte;
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
    public function getAvatar(): int
    {
        return $this->avatar;
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
    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getSexe(): string
    {
        return $this->sexe;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDateNaiss(): string
    {
        return $this->dateNaiss;
    }

    public static function getUser(PDO $conn, string $uid): ?Compte
    {
        $request = $conn->prepare(
            "SELECT
                c.idCompte,
                c.idVille,
                v.nomVille,
                c.avatar,
                p.photo,
                c.tel,
                c.nom,
                c.prenom,
                c.sexe,
                c.email,
                c.dateNaiss
            FROM
                compte c
                INNER JOIN
                ville v
                ON c.idVille = v.idVille
                INNER JOIN
                photo p
                ON c.avatar = p.idPhoto
            WHERE c.idCompte = :uid
        ");
        $request->execute(array(
            'uid' => $uid
        ));
        $result = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        if(sizeof($result) == 1){
            return $result[0];
        }
        return null;
    }

    public static function exists(PDO $conn, string $email, string $password): ?int
    {
        $request = $conn->prepare(
            "SELECT
                idCompte,
                hashAuth
            FROM auth
            WHERE idCompte IN(
                SELECT idCompte
                FROM
                    compte
                    INNER JOIN
                    admin
                    on compte.idCompte = admin.idAdmin
                    WHERE compte.email = :email
            )
            "
        );
        $request->execute(array(
            'email' => $email
        ));
        $result = $request->fetchAll();
        if(sizeof($result) == 1)
        {
            $admin = $result[0];
            if(password_verify($password, $admin['hashAuth'])){
                return $admin['idCompte'];
            }
        }
        return null;
    }
}