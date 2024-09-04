<?php

namespace App\Controllers;

class SkillsController extends Controller
{
    public function index()
    {
        return $this->render('skills');
    }
}