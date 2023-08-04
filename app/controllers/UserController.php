<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\interfaces\IDataProvider;
use app\models\User;
use app\providers\ApiProvider;
use app\providers\DatabaseProvider;
use app\UserValidator;

class UserController extends Controller
{
    public User $user;
    public Request $request;
    public UserValidator $userValidator;
    public Response $response;
    public IDataProvider $provider;
    public Session $session;

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->session = new Session();
        $this->provider = $this->session->get('data-source') === 'local'
            ? new DatabaseProvider()
            : new ApiProvider();
        $this->user = new User($this->provider);
        $this->userValidator = new UserValidator();
        $this->response = new Response();
    }

    public function index(): void
    {
        $this->view->render('user/create.twig');
    }

    public function show(): void
    {
        $request = $this->request->getBody();
        $limit = 10;

        $page = $request['page'] - 1;

        $users = $this->user->withLimit($page, $limit);

        $this->view->render(
            '/user/index.twig',
            [
                'users' => $users,
                'totalUsers' => count($this->user->all()),
                'totalPages' => ceil(count($this->user->all()) / $limit),
            ]
        );
    }

    public function create(): void
    {
        $request = $this->request->getBody();
        $this->userValidator->loadData($request);

        if (!$this->userValidator->validate()) {
            $this->view->render(
                'user/create.twig',
                [
                    'user' => $request,
                    'errors' => $this->userValidator->errors
                ]
            );
        }

        $this->user->create($request);

        if ($this->userValidator->validate()) {
            $this->response->redirect('/users?page=1');
        }
    }

    public function delete(): void
    {
        $request = $this->request->getBody();
        $ids = $request['ids'];
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        foreach ($ids as $id) {
            $this->user->delete($id);
        }

        $this->response->redirect('/users?page=1');
    }

    public function edit(string $id): void
    {
        $user = $this->user->first($id);

        $this->view->render(
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

    public function update(string $id): void
    {
        $request = $this->request->getBody();

        $this->user->update($request, $id);

        $this->response->redirect('/users?page=1');
    }
}
