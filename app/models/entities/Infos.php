<?php

class Infos
{
private int $idInfos;
private int $idPhoto;
private String $nom;
private String $email;
private String $tel;
private String $desc;

public function getInfos():array{
    return[
        "idInfos"=>$this->idInfos,
        "idPhoto"=>$this->idPhoto,
        "nom"=>$this->nom,
        "email"=>$this->email,
        "tel"=>$this->tel,
        "desc"=>$this->desc
    ];
}
}