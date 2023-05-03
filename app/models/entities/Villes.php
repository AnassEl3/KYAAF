<?php

class Villes
{
    private int $idVille;
    private string $nomVille;

    public function getInfos():array
    {
        return [
          "idVille" => $this->idVille,
          "nomVille" => $this->nomVille
        ];
    }

}