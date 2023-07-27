<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;

class AppController extends Controller
{
    public function index(): void
    {
        echo $this->view->render('index.twig');
    }
}