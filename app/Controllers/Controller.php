<?php

namespace App\Controllers;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require_once APP_ROOT . "/app/Views/$view.php";
    }
    
    protected function getRequestData(array $fields): array
    {
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = !empty($_POST[$field]) ? $_POST[$field] : null;
        }
        return $data;
    }


    protected function redirect(string $path): void
    {
        header("Location: " . URL_ROOT . "/$path");
        exit;
    }
}