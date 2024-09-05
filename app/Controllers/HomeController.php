<?php 

namespace App\Controllers;

use App\Models\Text;

class HomeController extends Controller
{
    private Text $text;

    public function __construct()
    {
        $this->text = new Text();
    }

    public function index()
    {
        $texts = $this->text->getAll();
        return $this->render('home', compact('texts'));
    }
}
