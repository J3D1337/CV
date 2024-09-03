<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function showRegister()
    {
        return $this->render('/register');
    }

    public function register()
    {
        $data = $this->getRequestData(['email', 'password', 'password_repeat']); 

        // TODO: validate data

    // Check if passwords match
    if ($data['password'] !== $data['password_repeat']) {
        // Passwords don't match, redirect back to the registration page
        return $this->redirect('register?error=password_mismatch');
    }

    // Redirect back to the registration page if the email is already taken

    if ($this->user->findByEmail($data['email'])) {
        return $this->redirect('register?email_error=email_taken');
    }

    // Unset the repeated password as it's not needed in the database
    unset($data['password_repeat']);
        

        try {
            $this->user->create($data);   
        } catch (\Exception $e) {
            return $this->redirect('/register');
        }

        return $this->redirect('login');
    }

    public function showLogin()
    {
        return $this->render('login');
    }

    public function login()
    {
        [$email, $password] = array_values($this->getRequestData(['email', 'password']));
        
        $user = $this->user->findByEmail($email);
        
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->redirect('login?error=invalid_credentials');
        }

        $_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email']];
        
        $this->redirect('UserHome');
    }
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->redirect('home');
    }


}