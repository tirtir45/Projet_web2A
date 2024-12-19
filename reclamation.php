<?php
class Reclamation
{
    private ?int $id = null;
    private ?string $objet;
    private ?string $detail;
    private ?string $statut;
    private ?DateTime $datee;
    private ?string $categorie;


   public function __construct($a,$b,$c,$d,$e,$f)

   {
    $this->id = $a;
    $this->objet = $b;
    $this->detail = $c;
    $this->statut = $d;
    $this->datee = $e;
    $this->categorie = $f;
}

public function getId()
{
    return $this->id;
}

public function setId(int $a)
{
    $this->id = $a;
}

public function getObjet()
{
    return $this->objet;
}

public function setObjet(string $b)
{
    $this->objet = $b;
}

public function getDetail()
{
    return $this->detail;
}

public function setDetail(string $c)
{
    $this->detail = $c;
}

public function getStatut(){
        return $this->statut;
}

public function setStatut(string $d)
{
    $this->statut = $d;
}

public function getDatee()
{
    return $this->datee;
}

public function setDatee(DateTime $e)
{
    $this->datee = $e;
}

public function getCategorie()
{
    return $this->categorie;
}

public function setCategorie(string $f)
{
    $this->categorie = $f;
}
}
?>