<?php

namespace App\Controllers;

class GoalsController extends Controller
{
    public function index()
    {
        return $this->render('goals');
    }
}