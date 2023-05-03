<?php

class Auth
{
    private int $idAuth;
    private int $idCompte;

    public function getInfos() : array
    {
        return [
            "idAuth" => $this->idAuth,
            "idCompte" =>$this->idCompte
        ];
    }


}