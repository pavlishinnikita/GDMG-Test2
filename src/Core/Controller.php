<?php

namespace App\Core;

use App\Core\View;

abstract class Controller 
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    function render(string $page, array $environment = array())
    {
        echo $this->view->render($page, $environment);
    }

    function redirect(string $urlTo):void
    {
        header("Location: {$urlTo}");
    }
}