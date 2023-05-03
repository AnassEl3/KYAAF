<?php

class Admin
{
    public static function isValidAdmin(PDO $conn, string $email, string $password): ?int
    {
        $request = $conn->prepare(
            "SELECT
                c.idCompte,
                au.hashAuth
            FROM
                admin ad
                INNER JOIN
                compte c
                ON ad.idAdmin = c.idCompte
                INNER JOIN
                auth au on c.idCompte = au.idCompte
            WHERE
                  c.email=:email
        ");
        $request->execute(array(
            'email' => $email
        ));
        $result = $request->fetchAll();
        if(sizeof($result) != 0)
        {
            if(password_verify($password, $result[0]['hashAuth']))
                return $result[0]['idCompte'];
        }
        return null;
    }
}