<?php
class Reservation{
	private ?int $_id;
    private ?int $_idC;
    private ?int $_idE;
    private ?string $_details;
    private ?DateTime $_dateC;
    private ?DateTime $_dateR;
    private ?string $_etat;

// Constructor
    public function __construct(?int $id, ?int $idC, ?int $idE, ?DateTime $dateR, ?DateTime $dateC, ?string $details, ?string $etat)
    {

        $this->_id = $id;
        $this->_idC = $idC;
        $this->_idE = $idE;
        $this->_dateC = $dateC;
        $this->_dateR = $dateR;
        $this->_details = $details;
        $this->_etat = $etat;
    }
    //Getters
    public function getId(): ?int {
        return $this->_id;
    } public function getIdE(): ?int {
        return $this->_idE;
    } public function getIdC(): ?int {
        return $this->_idC;
    }
    public function getDateC(): ?DateTime {
        return $this->_dateC;
    }
    public function getDateR(): ?DateTime {
        return $this->_dateR;
    }
    public function getDetails(): ?string {
        return $this->_details;
    }
    public function getEtat(): ?string {
        return $this->_etat;
    }
    
    // Setters
    public function setId(?int $id): void {
        $this->_id = $id;
    }public function setIdC(?int $idC): void {
        $this->_idC = $idC;
    }public function setIdE(?int $idE): void {
        $this->_idE = $idE;
    }
    public function setDateC(?DateTime $dateC): void {
        $this->_dateC = $dateC;
    }
    public function setDateR(?DateTime $dateR): void {
        $this->_dateR = $dateR;
    }
    public function setDetails(?string $details): void {
        $this->_details = $details;
    }
    public function setEtat(?string $etat): void {
        $this->_etat = $etat;
    }
}
    
?>