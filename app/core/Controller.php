<?php

declare(strict_types=1);

namespace app\core;

class Controller
{
    public Model $model;
    public View $view;

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }
}
