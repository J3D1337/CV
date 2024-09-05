<?php 
namespace App\Controllers;

use App\Middlewares\Auth;
use App\Models\Text;

class UserController extends Controller
{
    private Text $text;

    public function __construct()
    {
        Auth::isGuest();
        $this->text = new Text();
    }

    public function index()
    {
        $texts = $this->text->getAll();
        return $this->render('UserHome', compact('texts'));
    }

    public function createText()
    {
        $data = $this->getRequestData(['text_name', 'content', 'type']);
        $data['user_id'] = $_SESSION['user']['id'];
        $this->text->create($data);
        $this->redirect('UserHome');
    }

    public function editText(int $id)
    {
        $text = $this->text->find($id);
        return $this->render('edit_text', compact('text'));
    }

    public function updateText(int $id)
    {
        $data = $this->getRequestData(['text_name', 'content', 'type']);
        $this->text->update($id, $data); 
        $this->redirect('UserHome');
    }

    
    public function deleteText(int $id)
    {
        $this->text->delete($id); 
        $this->redirect('UserHome');
    }
}
