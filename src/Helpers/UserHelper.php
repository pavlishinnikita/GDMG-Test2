<?php

namespace App\Helpers;

class UserHelper
{
    public function isAuth($pass, $hash)
    {
        return password_verify($pass, $hash);
    }

    public function generateHash($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}
