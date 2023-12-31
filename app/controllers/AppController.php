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
        $this->session = Session::getInstance();
    }

    public function index()
    {
        $request = $this->request->getBody();

        if (isset($request['data-source'])) {
            $this->session->set('data-source', $request['data-source']);
        }

        return $this->view->render('index.twig', ['dataSource' => $this->session->get('data-source')]);
    }
}
