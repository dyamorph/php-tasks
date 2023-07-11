<?php

declare(strict_types=1);

namespace controllers;

use core\Controller;
use models\UserModel;

class UserController extends Controller
{
    public UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function new(): void
    {
        $this->view->render('new.php', 'template.php');
    }

    public function create(): void
    {
        if ( ! empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
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
        if ( ! empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $status = $_POST['status'];
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
}
