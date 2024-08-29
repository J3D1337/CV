<?php

namespace App\Models;

use App\Services\Database;

class Model
{
    protected Database $db;
    protected string $table;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function all(){
        return $this->db->table($this->table)->get();
    }
}