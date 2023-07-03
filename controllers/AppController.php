<?php
declare(strict_types=1);

// namespace Controllers;
// use \Core\Controller;

class AppController extends Controller
{
    public function index()
    {
        return $this->view->render('mainpage.php', 'template.php');
    }
}
