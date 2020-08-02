<?php

namespace App\Core;

class View 
{
    function render ($page, array $environment = array()) {
        extract($environment);
        ob_start();
        include ROOT . "src\\Views\\" . $page . '.php';
        $content = ob_get_clean();
        // $content is required name of variable for all files that used with template
        extract(['content' => $content]);
        ob_start();
        include ROOT . "src\\Views\\" . 'template' . '.php';
        return ob_get_clean();
    }
}
