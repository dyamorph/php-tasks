<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;

class UserController extends Controller
{
    public function new()
    {
        $this->view->render('newuser.php', 'template.php');
    }

    public function create()
    {
        $this->view->render('userinfo.php', 'template.php');
    }

    public function all()
    {
        $this->view->render('show.php', 'template.php');
    }
}
