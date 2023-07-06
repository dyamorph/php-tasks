<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;

class AppController extends Controller
{
    public function index()
    {
        $this->view->render('mainpage.php', 'template.php');
    }
}
