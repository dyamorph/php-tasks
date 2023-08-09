<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Session;

class AppController extends Controller
{
    public Request $request;
    public Session $session;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->session = new Session();
    }

    public function index(): void
    {
        $request = $this->request->getBody();

        if (isset($request['data-source'])) {
            $this->session->set('data-source', $request['data-source']);
        }

        $this->view->render('index.twig', ['dataSource' => $this->session->get('data-source')]);
    }
}
