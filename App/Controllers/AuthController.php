<?php

namespace App\Controllers;

use App\Helpers\JsonResponse;
use App\Helpers\RedirectResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Views\View;

class AuthController
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function register()
    {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        $userModel = new User();
        $userModel->setName($data['name']);
        $userModel->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));
        $userModel->setEmail($data['email']);

        $existingUser = $this->repository->getByEmail($userModel->getEmail());
        if ($existingUser) {
            View::error(new \Exception('User with this email already exists', 400));
        }

        $this->repository->createUser($userModel);

        RedirectResponse::redirect('/login');
    }

    public function login()
    {
        session_start();

        $data = [
            'name' => $_POST['name'],
            'password' => $_POST['password']
        ];

        $userModel = new User($data['name'], $data['password']);
        $userModel->setName($data['name']);
        $userModel->setPassword($data['password']);

        $user = $this->repository->getByName($userModel->getName());


        if ($user && password_verify($data['password'], $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            if ($user['name'] === 'admin' && password_verify('admin', $user['password'])) {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }
            RedirectResponse::redirect('/users');
            exit;
        } else {
            View::error(new \Exception('Invalid credentials', 403));
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        RedirectResponse::redirect('/');
        exit;
    }

    public function getCurrentUser()
    {
        session_start();
        if (!$_SESSION) {
            RedirectResponse::redirect('/');
        }
        JsonResponse::send(
            [
                'id' => $_SESSION['id'],
                'role' => $_SESSION['role'],
                'name' => $_SESSION['name']
            ]
        );
    }
}