<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AppController extends Controller
{
    public Request $request;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
    }

    public function index(): void
    {
        $data = $this->request->getBody();
        if ($this->request->getMethod() === 'POST') {
            if (isset($data['data-source']) && in_array($data['data-source'], ['local', 'gorest'])) {
                $_SESSION['data-source'] = $data['data-source'];
            }
        }
        echo $this->view->render('index.twig', ['data' => $_SESSION]);
    }
}
