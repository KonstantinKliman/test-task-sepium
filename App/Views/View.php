<?php

namespace App\Views;

class View
{
    public static function show(string $page)
    {
        require_once 'Pages/' . $page . '.tpl.php';
        exit;
    }

    public static function error(\Exception $exception)
    {
        http_response_code($exception->getCode());
        require_once 'Pages/error.tpl.php';
        exit;
    }
}