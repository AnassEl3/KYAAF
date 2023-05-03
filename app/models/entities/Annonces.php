<?php

class Annonces
{
    private int $idAnn;
    private int $idVille;
    private string $idCompte;
    private float $idSousCat;
    private string $miniature;
    private string $titre;
    private string $prix;
    private string $etat;
    private string $dateAnn;
    private string $descAnn;

    public function getInfo() : array{
        return[
            "idAnn" => $this->idAnn,
            "idVille" => $this->idVille,
            "idCompte" => $this->idCompte,
            "idSousCat" => $this->idSousCat,
            "miniature" => $this->miniature,
            "titre" => $this->titre,
            "prix" => $this->prix,
            "etat" => $this->etat,
            "dateAnn" => $this->dateAnn,
            "descAnn" => $this->descAnn

        ];
    }
}