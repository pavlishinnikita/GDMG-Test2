<?php

namespace App\Models;

use App\Core\Model;

class LoginAttempts extends Model
{
    public static $MINUTES_TO_BLOCK = 5;
    public $name;
    public $attemptCount;
    public $date;
    public $ip;
    protected function fileName()
    {
        return 'attempts.json';
    }
}
