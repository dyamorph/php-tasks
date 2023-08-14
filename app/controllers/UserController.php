<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\core\View;
use app\interfaces\IDataProvider;
use app\models\User;
use app\providers\ApiProvider;
use app\providers\DatabaseProvider;
use app\UserValidator;

class UserController extends Controller
{
    public User $user;
    public Request $request;
    public UserValidator $validator;
    public Response $response;
    public IDataProvider $provider;
    public Session $session;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->session = Session::getInstance();
        $this->provider = $this->session->get('data-source') === 'local'
            ? new DatabaseProvider('users', '*', 'id')
            : new ApiProvider(
                'https://gorest.co.in/public/v2/users',
                [
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Authorization: Bearer 91c0714d833bc0830a709ccdbf6135d7b515a8de33e2f30db58bdc18fdcc5426"
                ]
            );
        $this->user = new User($this->provider);
        $this->validator = new UserValidator();
        $this->response = new Response();
    }

    public function index(): View
    {
        return $this->view->render('user/create.twig');
    }

    public function show(): View
    {
        $request = $this->request->getBody();
        $limit = 10;
        $page = 0;

        if (isset($request['page'])) {
            $page = $request['page'] - 1;
        }

        $users = $this->user->withLimit($page, $limit);

        if (!isset($users) && count($users) === 0) {
            return $this->view->render(
                '/layout/error.twig',
                [
                    'errorMessage' => 'Users not found!'
                ]
            );
        }

        return $this->view->render(
            '/user/index.twig',
            [
                'users' => $users,
                'totalUsers' => count($this->user->all()),
                'totalPages' => ceil(count($this->user->all()) / $limit),
            ]
        );
    }

    public function create(): View
    {
        $request = $this->request->getBody();
        $this->validator->loadData($request);

        if (!$this->validator->validate()) {
            return $this->view->render(
                'user/create.twig',
                [
                    'user' => $request,
                    'errors' => $this->validator->errors
                ]
            );
        }

        $this->user->create($request);

        return $this->response->redirect('/users?page=1');
    }

    public function delete(): View
    {
        $request = $this->request->getBody();

        if (!isset($request['ids']) || count($request['ids']) === 0) {
            return $this->view->render(
                '/layout/error.twig',
                [
                    'errorMessage' => 'Error during deleting! User not found!'
                ]
            );
        }

        foreach ($request['ids'] as $id) {
            $this->user->delete($id);
        }

        return $this->response->redirect('/users?page=1');
    }

    public function edit(string $id): View
    {
        $user = $this->user->first($id);

        if (!isset($user)) {
            return $this->view->render(
                '/layout/error.twig',
                [
                    'errorMessage' => 'User not found'
                ]
            );
        }

        return $this->view->render(
            'user/edit.twig',
            [
                'id'     => $user['id'],
                'name'   => $user['name'],
                'email'  => $user['email'],
                'gender' => $user['gender'],
                'status' => $user['status']
            ]
        );
    }

    public function update(string $id): View
    {
        $user = $this->user->first($id);

        if (!isset($user)) {
            return $this->view->render(
                '/layout/error.twig',
                [
                    'errorMessage' => 'User not found'
                ]
            );
        }

        $request = $this->request->getBody();

        $this->user->update($request, $id);

        return $this->response->redirect('/users?page=1');
    }
}
