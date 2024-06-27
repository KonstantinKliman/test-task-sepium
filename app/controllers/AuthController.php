<?php

namespace App\Controllers;

use App\Helpers\JsonResponse;
use App\Helpers\RedirectResponse;
use App\Models\User;
use App\Views\View;

class AuthController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            $user = new User();

            $existingUser = $user->findByEmail($data['email']);
            if ($existingUser) {
                throw new \Exception('User with this email already exists', 400);
            }

            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setCreatedAt(date('Y-m-d H:i:s'));
            $user->save();
            RedirectResponse::redirect('/login');
        }
    }

    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'password' => $_POST['password']
            ];

            $user = new User();
            $userData = $user->findByName($data['name']);

            if ($userData && password_verify($data['password'], $userData['password'])) {
                $_SESSION['id'] = $userData['id'];
                $_SESSION['name'] = $userData['name'];
                if ($userData['name'] === 'admin' && password_verify('admin', $userData['password'])) {
                    $_SESSION['role'] = 'admin';
                } else {
                    $_SESSION['role'] = 'user';
                }
                RedirectResponse::redirect('/users');
                exit;
            } else {
                throw new \Exception('Invalid credentials', 403);
            }
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
        JsonResponse::send(
            [
                'id' => $_SESSION['id'],
                'role' => $_SESSION['role'],
                'name' => $_SESSION['name']
            ]
        );
    }
}