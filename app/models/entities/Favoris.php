<?php

class Favoris
{
private int $idCompte;
private int $idAnn;

public function getInfo():array{
    return[
        "idCompte"=>$this->idCompte,
        "idAnn"=>$this->idAnn
    ];
}
}