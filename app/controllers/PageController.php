<?php

namespace App\Controllers;

use App\Models\User;
use App\Views\View;

class PageController
{
    public function index()
    {
        View::show('index');
    }

    public function registerPage()
    {
        View::show('register');
    }

    public function loginPage()
    {
        View::show('login');
    }

    public function usersPage()
    {
        View::show('users');
    }
}
