<?php

namespace App\Core;
use App\Core\Router;
use App\Models\LoginAttempts;
use DateInterval;
use DateTime;

class Kernel 
{
    private static $instance;
    public $request;

    private function __clone() {}

    private function __construct() {}

    public static function getInstance():Kernel {
        if(Kernel::$instance == null) {
            Kernel::$instance = new Kernel();
        }
        return Kernel::$instance;
    }

    public function handle($request):void {
        $this->request = $request;
        $router = Router::getInstance();
        if($this->throttling()) {
            $router->find('/error/block/');
        } else {
            $router->find($_SERVER['REDIRECT_URL'] ?? '');
        }
    }

    public function throttling() {
        $sessionStorage = new SessionStorage();
        $loginAttempts = new LoginAttempts();
        $client = $loginAttempts->findOne('ip', $this->request->getData('server', 'REMOTE_ADDR'));
        if($client->ip != NULL && $client->attemptCount <= 0) {
            $now = new DateTime("now");
            $interval = $now->diff(new DateTime($client->date['date']));
            if($interval->i >= LoginAttempts::$MINUTES_TO_BLOCK) {
                $sessionStorage->clear('blockTime');
                $sessionStorage->clear('attempts');
                return false;
            }
            $test = new DateTime($client->date['date']);
            $test = $test->add(new DateInterval('PT' . LoginAttempts::$MINUTES_TO_BLOCK  . 'M'));
            $sessionStorage->add('blockTime', $test->format('Y-m-d H:i:s'));
            return true;
        }
        return false;
    }
}
