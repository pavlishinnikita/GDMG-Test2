<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Kernel;

class MainController extends Controller
{
  public function actionIndex()
  {
    // first page for greeting interviewers
    return $this->render('main\main');
  }
}
