<?php

class Ann_photos
{
    private int $idPhoto;
    private int $idAnn;

    public function getInfo() : array{
        return[
            "idPhoto" => $this->idPhoto,
            "idAnn" => $this->idAnn
        ];
    }
}