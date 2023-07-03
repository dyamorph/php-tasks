<?php
declare(strict_types=1);

// namespace Core;

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
        $this->model = new Model();
	}
}