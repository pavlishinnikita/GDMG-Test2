<?php

namespace App\Core;

class Request 
{
    private $data;
    public $isPost;
    public $isGet;

    public function __construct()
    {
        $this->data['get'] = $_GET;
        $this->data['post'] = $_POST;
        $this->data['server'] = $_SERVER;
        $this->isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $this->isGet = $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function getData(string $from, string $that) 
    {
        return $this->data[$from][$that];
    }
}

