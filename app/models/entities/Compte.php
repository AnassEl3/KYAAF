<?php

class Compte
{
    private int $idCompte;
    private int $idVille;
    private string $nom;
    private string $prenom;
    private string $sexe;
    private string $tel;
    private string $email;
    private string $avatar;
    private string $dateNaiss;

    public function getInfos():array{
        return [
            "idCompte" => $this->idCompte,
            "idVille" => $this->idVille,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "sexe" => $this->sexe,
            "telephone" => $this->tel,
            "email" => $this->email,
            "avatar" => $this->avatar,
            "dateNaiss" => $this->dateNaiss
        ];
    }
}

