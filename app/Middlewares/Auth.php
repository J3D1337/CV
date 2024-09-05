<?php

namespace App\Middlewares;

class Auth
{
    public static function isGuest(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location:'.URL_ROOT.'/login');
            exit;
        }
    }

    public static function isAuthenticated(): void
    {
        if (isset($_SESSION['user'])) {
            header('Location:'.URL_ROOT.'/UserHome');
            exit;
        }
    }


}



