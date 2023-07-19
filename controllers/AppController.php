<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;

class AppController extends Controller
{
    public function index(): void
    {
        $this->view->render('index.php', 'template.php');
    }
}
