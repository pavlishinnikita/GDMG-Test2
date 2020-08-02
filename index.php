<?php
session_start();

use App\Core\Kernel;
use App\Core\Request;


include_once 'vendor/autoload.php';
define('ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);

// entry point of app

$kernel = Kernel::getInstance();
$req = new Request();
$kernel->handle($req);
