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
        $session = $this->request->getSession();
        $data = $this->request->getBody();
        $this->userValidator->loadData($data);
        if (!$this->userValidator->validate()) {
            echo $this->view->render(
                'new.twig',
                [
                    'data' => $data,
                    'errors' => $this->userValidator->errors
                ]
            );
        }
        if ($session['data-source'] === 'local') {
            $name = $data['name'];
            $email = $data['email'];
            $gender = $data['gender'];
            $status = $data['status'];

            $this->userModel->setToDatabase(
                'users',
                ['name', 'email', 'gender', 'status'],
                [$name, $email, $gender, $status]
            );
        } else {
            $this->userModel->setToAPI($data);
        }
        $this->response->redirect("/users");
    }

    public function show(): void
    {
        $session = $this->request->getSession();
        if ($session['data-source'] === 'local') {
            $results = $this->userModel->getAll('users', '*');
            $totalUsers = count($results);
            $limit = 10;
            $offset = 0;
            $pages = ceil($totalUsers / $limit);
            if (isset($_GET['page'])) {
                $page = $_GET['page'] - 1;
                $offset = $page * $limit;
            }
            $limitResults = $this->userModel->getWithLimitFromDatabase('users', "*", $limit, $offset);
        } else {
            $page = $_GET['page'] ?? 1;
            $perPage = 10;
            [$limitResults, $totalUsers] = $this->userModel->getWithLimitFromAPI($page, $perPage);
            $pages = ceil($totalUsers / $perPage);
        }
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
        $session = $this->request->getSession();
        if ($session['data-source'] === 'local') {
            if ($this->userModel->deleteFromDatabase('users', $id)) {
                $this->response->redirect('/users');
            } else {
                $this->response->message('Error while deleting');
            }
        } else {
            $this->userModel->deleteFromAPI($id);
            $this->response->redirect('/users');
        }
    }

    public function deleteSome(): void
    {
        $session = $this->request->getSession();
        $data = $this->request->getBody();
        if ($session['data-source'] === 'local') {
            foreach ($data['ids'] as $id) {
                if ($this->userModel->deleteFromDatabase('users', $id)) {
                    $this->response->redirect('/users');
                }
            }
            $this->response->message('Error while deleting');
        } else {
            foreach ($data['ids'] as $id) {
                if ($this->userModel->deleteFromAPI($id)) {
                    $this->response->redirect('/users');
                }
            }
            $this->response->redirect('/users');
        }
    }

    public function edit(string $id): void
    {
        $session = $this->request->getSession();
        if ($session['data-source'] === 'local') {
            $results = $this->userModel->getOneFromDatabase('users', ['*'], 'id', $id);
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
        } else {
            $results = $this->userModel->getOneFromAPI($id);
            echo $this->view->render(
                'edit.twig',
                [
                    'id'     => $results['id'],
                    'name'   => $results['name'],
                    'email'  => $results['email'],
                    'gender' => $results['gender'],
                    'status' => $results['status']
                ]
            );
        }
    }

    public function update(string $id): void
    {
        $session = $this->request->getSession();
        $request = $this->request->getBody();
        if ($session['data-source'] === 'local') {
            $name = $request['name'];
            $email = $request['email'];
            $gender = $request['gender'];
            $status = $request['status'];

            $this->userModel->updateFromDatabase(
                'users',
                ['name', 'email', 'gender', 'status'],
                [$name, $email, $gender, $status],
                'id',
                $id
            );
        } else {
            $this->userModel->updateFromAPI($request, $id);
        }
        $this->response->redirect('/users');
    }
}
