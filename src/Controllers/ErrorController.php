<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Kernel;
use App\Core\SessionStorage;

class ErrorController extends Controller
{
    public function actionIndex() 
    {
        echo "Not found 404";
    }

    public function actionBlock() 
    {
        $sessionStorage = new SessionStorage();
        $time = $sessionStorage->get('blockTime');
        return $this->render('error/block', ['time' => $time]);
    }
}
