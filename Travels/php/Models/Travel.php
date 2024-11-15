<?php
class Travel{
	private ?int $idTravel=null;
	private ?string $Title=null;
	private ?string $Category=null;
	private ?float $Price=null;
	public function __construct($id=null, $t, $c, $p){
		$this->idTravel=$id;
		$this->Title=$t;
		$this->Category=$c;
		$this->Price=$p;
	}
	public function getIdTravel()
	{
		return $this->idTravel;
	}
	public function getTitle()
	{
		return $this->Title;
	}
	public function getCategory()
	{
		return $this->Category;
	}
	public function getPrice()
	{
		return $this->Price;
	}
	public function setCategory($cate)
	{
		$this->Category=$cate;
		return $this;
	}
	public function setPrice($prc)
	{
		$this->Price=$prc;
		return $this;
	}
	public function setTitle($titl)
	{
		$this->Title=$titl;
		return $this;
	}
	
	
}


?>