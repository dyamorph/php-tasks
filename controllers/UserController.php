<?php
declare(strict_types=1);

// namespace Controllers;
// use \Core\Controller;

class UserController extends Controller
{
    public function new()
    {
        return $this->view->render('newuser.php', 'template.php');
    }
    public function create()
    {
        return $this->view->render('userinfo.php', 'template.php');
    }
}