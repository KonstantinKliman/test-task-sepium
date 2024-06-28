<?php

namespace App\Controllers;

use App\Helpers\JsonResponse;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getAllUsers()
    {
        $users = $this->repository->getAllUsers() ;

        if ($users) {
            JsonResponse::send($users);
        } else {
            JsonResponse::send([]);
        }
    }

    public function createUser()
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
            JsonResponse::send(['error' => 'User with this email already exists.'], 400);
            return;
        }

        $user = $this->repository->createUser($userModel);
        if ($user) {
            JsonResponse::send($user);
        } else {
            JsonResponse::send([]);
        }
    }

    public function deleteUser()
    {
        session_start();
        $deletedUserId = $_POST['id'];
        if ($deletedUserId && $_SESSION['role'] === 'admin') {
            $user = new User();
            $user->setId($deletedUserId);
            $this->repository->deleteUser($user->getId());
            JsonResponse::send(['message' => 'User successfully deleted.']);
        } else {
            JsonResponse::send(['message' => 'Unauthorized'], 403);
        }
    }
}