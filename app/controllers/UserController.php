<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\UserModel;
use app\UserValidator;

class UserController extends Controller
{
    public UserModel $userModel;
    public Request $request;
    public UserValidator $userValidator;
    public Response $response;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->request = new Request();
        $this->userValidator = new UserValidator();
        $this->response = new Response();
    }

    public function index(): void
    {
        echo $this->view->render('new.twig');
    }

    public function create(): void
    {
        $data = $this->request->getBody();
        $this->userValidator->loadData($data);
        if (!$this->userValidator->validate()) {
            echo $this->view->render(
                'new.twig',
                [
                    'data'   => $data,
                    'errors' => $this->userValidator->errors
                ]
            );
        } else {
            $name = $data['name'];
            $email = $data['email'];
            $gender = $data['gender'];
            $status = $data['status'];

            $this->userModel->set(
                'users',
                ['name', 'email', 'gender', 'status'],
                [$name, $email, $gender, $status]
            );
            $this->response->redirect("/users");
        }
    }

    public function show(): void
    {
        $results = $this->userModel->getAll('users', '*');
        $totalUsers = count($results);
        $limit = 10;
        $offset = 0;
        $pages = ceil($totalUsers / $limit);
        if (isset($_GET['page'])) {
            $page = $_GET['page'] - 1;
            $offset = $page * $limit;
        }
        $limitResults = $this->userModel->getWithLimit('users', "*", $limit, $offset);
        echo $this->view->render(
            'show.twig',
            [
                'results'    => $limitResults,
                'totalUsers' => $totalUsers,
                'pages'      => $pages,
            ]
        );
    }

    public function delete(string $id): void
    {
        if ($this->userModel->delete('users', $id) === true) {
            $this->response->redirect('/users');
        } else {
            $this->response->message('Error while deleting');
        }
    }

    public function deleteSome(): void
    {
        $data = $this->request->getBody();
        foreach ($data['ids'] as $id) {
            if ($this->userModel->delete('users', $id) !== true) {
                $this->response->message('Error while deleting');
            }
        }
        $this->response->redirect('/users');
    }

    public function edit(string $id): void
    {
        $results = $this->userModel->getOne('users', ['*'], 'id', $id);
        echo $this->view->render(
            'edit.twig',
            [
                'id'     => $results[0]['id'],
                'name'   => $results[0]['name'],
                'email'  => $results[0]['email'],
                'gender' => $results[0]['gender'],
                'status' => $results[0]['status']
            ]
        );
    }

    public function update(string $id): void
    {
        $request = $this->request->getBody();

        $name = $request['name'];
        $email = $request['email'];
        $gender = $request['gender'];
        $status = $request['status'];

        $this->userModel->update(
            'users',
            ['name', 'email', 'gender', 'status'],
            [$name, $email, $gender, $status],
            'id',
            $id
        );
        $this->response->redirect('/users');
    }
}
