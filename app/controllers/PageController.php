<?php

namespace App\Controllers;

use App\Helpers\RedirectResponse;
use App\Views\View;

class PageController
{
    public function index()
    {
        View::show('index');
    }

    public function registerPage()
    {
        session_start();
        if ($_SESSION) {
            RedirectResponse::redirect('/users');
        }
        View::show('register');
    }

    public function loginPage()
    {
        session_start();
        if ($_SESSION) {
            RedirectResponse::redirect('/users');
        }
        View::show('login');
    }

    public function usersPage()
    {
        session_start();
        if (!$_SESSION) {
            RedirectResponse::redirect('/');
        }
        View::show('users');
    }
}
