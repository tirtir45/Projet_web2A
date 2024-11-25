<?php

class Produit
{
    private $id;
    private $type;
    private $category;
    private $color;
    private $quantity;

    public function __construct($id, $type, $category, $color, $quantity)
    {
        $this->id = $id;
        $this->type = $type;
        $this->category = $category;
        $this->color = $color;
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}

?>
