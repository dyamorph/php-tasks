<?php
include_once("model/Model.php");
class Controller {
	public $model;

	public function __construct()  
    {  
        $this->model = new Model();
    } 
    public function mainPage() 
    {
        include 'view/mainpage.html';
    }
    public function newUser() 
    {
        include 'view/newuser.html';
    }
}
?>