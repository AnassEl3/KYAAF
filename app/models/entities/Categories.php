<?php

class Categories
{
private int $idCat;
private String $nomCat;
private ?int $idCatMere;

public function getInfos() : array
    {
        return [
            "idCat"=>$this->idCat,
            "nomCat"=>$this->nomCat,
            "idCatMere"=>$this->idCatMere
        ];
}
}