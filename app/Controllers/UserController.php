<?php

namespace App\Controllers;

use App\Middlewares\Auth;
use App\Models\User;



class UserController extends Controller
{

    public function __construct()
    {
        Auth::isGuest();
    }
    public function index()
    {

        return $this->render('UserHome');
    }
}