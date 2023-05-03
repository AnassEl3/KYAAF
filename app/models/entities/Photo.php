<?php

class Photo
{
private int $idPhoto;
private $photo;
public function getInfo() : array{
    return[
        "idPhoto"=>$this->idPhoto,
        "photo"=>$this->photo
    ];

}
}
