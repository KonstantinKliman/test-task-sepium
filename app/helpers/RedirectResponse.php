<?php

namespace App\Helpers;

class RedirectResponse
{
    public static function redirect(string $to)
    {
        header("Location: $to");
    }
}