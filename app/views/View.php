<?php

namespace App\Views;

class View
{
    public static function show(string $page)
    {
        require_once 'pages/' . $page . '.tpl.php';
    }
}