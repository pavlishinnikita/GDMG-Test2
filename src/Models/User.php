<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public $name;
    public $password;
    public $passwordHash;
    protected function fileName()
    {
        return 'users.json';
    }
}

