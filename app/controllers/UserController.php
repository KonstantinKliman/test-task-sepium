<?php

namespace App\Controllers;

use App\Helpers\JsonResponse;
use App\Models\User;

class UserController
{
    public function getAll()
    {
        $user = new User();
        $users = $user->findByColumns(['id', 'name', 'email']);
        if ($users) {
            JsonResponse::send($users);
        } else {
            JsonResponse::send([]);
        }
    }

    public function create()
    {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $user = new User();

        $existingUser = $user->findByEmail($data['email']);
        if ($existingUser) {
            JsonResponse::send(['error' => 'User with this email already exists.'], 400);
            return;
        }

        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setCreatedAt(date('Y-m-d H:i:s'));
        $userId = $user->save();
        $createdUser = $user->findById($userId,['id', 'email', 'name'])[0];
        if ($createdUser) {
            JsonResponse::send($createdUser);
        } else {
            JsonResponse::send([]);
        }
    }

    public function delete()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deletedUserId = $_POST['id'];
            if ($deletedUserId && $_SESSION['role'] === 'admin') {
                $user = new User();
                $user->deleteRecord($deletedUserId);
                JsonResponse::send(['message' => 'User successfully deleted.']);
            } else {
                JsonResponse::send(['message' => 'Unauthorized'], 403);
            }
        }
    }
}