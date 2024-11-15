<?php
require_once'../php/Models/Travel.php';
class TravelController{
	private $travelModel;
	public function __construct(){
		$this->travelModel=new Travel();
	}
	public function index(){
		
	}
}

?>