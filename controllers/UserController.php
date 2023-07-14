<?php

declare(strict_types=1);

namespace controllers;

use app\UserValidator;
use core\Controller;
use core\Request;
use models\UserModel;

class UserController extends Controller
{
    public UserModel $userModel;
    public Request $request;
    public UserValidator $userValidator;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->request = new Request();
        $this->userValidator = new UserValidator();
    }

    public function new(): void
    {
        $this->view->render('new.php', 'template.php');
    }

    public function create(): void
    {
        $data = $this->request->getBody();
        $this->userValidator->loadData($data);
        if (!$this->userValidator->validate()) {
            $this->view->render(
                'new.php',
                'template.php',
                [$data, $this->userValidator->errors]
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
            header("Location: /users");
        }
    }

    public function index(): void
    {
        $results = $this->userModel->getAll('users');
        $this->view->render(
            'show.php',
            'template.php',
            ['results' => $results]
        );
    }

    public function delete(string $id): void
    {
        $this->userModel->delete('users', $id);
        header("Location: /users");
    }

    public function edit(string $id): void
    {
        $results = $this->userModel->getOne('users', [], 'users.id', $id);
        $this->view->render(
            'edit.php',
            'template.php',
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
        $data = $this->request->getBody();

        $name = $data['name'];
        $email = $data['email'];
        $gender = $data['gender'];
        $status = $data['status'];

        $this->userModel->update(
            'users',
            ['name', 'email', 'gender', 'status'],
            [$name, $email, $gender, $status],
            'users.id',
            $id
        );
        header("Location: /users");
    }
}
