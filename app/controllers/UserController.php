<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
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

    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        $this->user = new User($this->request->getSession()['data-source'] === 'local' ? new DatabaseProvider() : new ApiProvider());
        $this->userValidator = new UserValidator();
        $this->response = new Response();
    }

    public function index(): void
    {
        $this->view->render('user/create.twig');
    }

    public function show()
    {
        $session = $this->request->getSession();
        $request = $this->request->getBody();
        $limit = 10;

        if ($session['data-source'] === 'local') {
            if (isset($request['page'])) {
                $page = $request['page'] - 1;
                $offset = $page * $limit;
            }

            $users = $this->user->withLimit($limit, $offset ?? 0, null);
        } else {
            $page = $request['page'] ?? 1;
            $users = $this->user->withLimit($limit, null, $page);
        }

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
        $session = $this->request->getSession();
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

        if ($session['data-source'] === 'local') {
            $this->user->create(
                ['name', 'email', 'gender', 'status'],
                [$request['name'], $request['email'], $request['gender'], $request['status']],
                null
            );
        } else {
            $this->user->create(null, null, $request);
        }

        if ($this->userValidator->validate()) {
            $this->response->redirect('/users');
        }
    }

    public function delete(string $id): void
    {
        if ($this->user->delete($id)) {
            $this->response->redirect('/users');
        } else {
            $this->response->message('Error while deleting');
        }
    }

    public function deleteSome(): void
    {
        $request = $this->request->getBody();

        foreach ($request['ids'] as $id) {
            if ($this->user->delete($id)) {
                $this->response->redirect('/users');
            }
        }

        $this->response->message('Error while deleting');
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
        $session = $this->request->getSession();
        $request = $this->request->getBody();

        if ($session['data-source'] === 'local') {
            $this->user->update(
                ['name', 'email', 'gender', 'status'],
                [$request['name'], $request['email'], $request['gender'], $request['status']],
                'id',
                $id,
                null,
                null
            );
        } else {
            $this->user->update(null, null, null, null, $request, $id);
        }

        $this->response->redirect('/users');
    }
}
