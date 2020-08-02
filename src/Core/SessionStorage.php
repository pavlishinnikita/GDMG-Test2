<?php

namespace App\Core;

class SessionStorage
{
    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function add(string $key, $value) : void
    {
        $_SESSION[$key] = $value;
    }

    public function clear(string $key) : void
    {
        if(key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    public function has($key) : bool
    {
        return key_exists($key, $_SESSION) && $_SESSION[$key] !== null;
    }
}
