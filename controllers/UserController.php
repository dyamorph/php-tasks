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
        $this->view->render('showall.php', 'template.php');
    }

    public function delete()
    {
        $this->view->render('delete.php', 'template.php');
    }

    public function update()
    {
        $this->view->render('edit.php', 'template.php');
    }
}
