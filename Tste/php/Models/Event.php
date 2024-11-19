<?php
class Event{
	private ?int $_id;
    private ?string $_title;
    private $_Pic;
    private ?string $_description;
    private ?string $_category;
    private ?bool $_available;
    private ?float $_price;

// Constructor
    public function __construct(?int $id, ?string $title, $pic, ?string $description,
    ?string $category, ?bool $available, ?float $price)
    {
        $this->_id = $id;
        $this->_title = $title;
        $this->_Pic = $pic;
        $this->_description = $description;
        $this->_category = $category;
        $this->_available = $available;
        $this->_price = $price;
    }
    //Getters
    public function getId(): ?int {
        return $this->_id;
    }
    public function getTitle(): ?string {
        return $this->_title;
    }
    public function getPic(): ?string {
        return $this->_Pic;
    }
    public function getDescription(): ?string {
        return $this->_description;
    }
    public function getCategory(): ?string {
        return $this->_category;
    }
    public function getAvailability(): ?bool {
        return $this->_available;
    }
    public function getPrice(): ?float {
        return $this->_price;
    }
    // Setters
  public function setId(?int $id): void {
        $this->_id = $id;
    }
    public function setTitle(?string $title): void {
        $this->_title = $title;
    }
    public function setPic($pic): void {
        $this->_Pic = $pic;
    }
    public function setDescription(?string $description): void {
        $this->_description = $description;
    }
    public function setCategory(?string $category): void {
        $this->_category = $category;
    }
    public function setAvailability(?bool $available): void {
        $this->_available = $available;
    }
    public function setPrice(?float $price): void {
        $this->_price = $price;
    }
}
    
?>