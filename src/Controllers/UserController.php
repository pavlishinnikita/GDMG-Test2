<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\JsonStorage;
use App\Core\Kernel;
use App\Core\SessionStorage;
use App\Helpers\UserHelper;
use App\Models\LoginAttempts;
use App\Models\User;
use DateTime;

class UserController extends Controller
{
    public function actionIndex() 
    {
        $sessionStorage = new SessionStorage();
        if(!$sessionStorage->get('isLogged') ?? false) {
            return $this->redirect('\user\login');
        }
        return $this->render('user\profile', ['username' => $sessionStorage->get('username')]);
    }

    public function actionLogin() 
    {
        $isError = false;
        $sessionStorage = new SessionStorage();
        $userHelper = new UserHelper();
        $request = Kernel::getInstance()->request;
        $userModel = new User();
        //

        if(!$sessionStorage->has('attempts')) {
            $sessionStorage->add('attempts', 2);
        }
        //
        if($request->isPost) {
            $username = $request->getData('post', 'username');
            $pass = $request->getData('post', 'password');
            $user = $userModel->findOne('name', $username);
            if($user != null && $userHelper->isAuth($pass, $user->passwordHash)) {
                $sessionStorage->add('isLogged', true);
                $sessionStorage->add('username', $user->name);
                return $this->redirect('\user');
            } else {
                $isError = true;
                $attempts = $sessionStorage->get('attempts') - 1;
                $attemptsLogin = new LoginAttempts();
                $attemptsLogin->attemptCount = $attempts;
                $attemptsLogin->name = $username;
                $attemptsLogin->date = new DateTime('now');
                $attemptsLogin->ip = $request->getData('server', 'REMOTE_ADDR');
                $attemptsLogin->save(true);
                $sessionStorage->add('attempts', $attempts);
            }
        }
        if($request->isGet && $sessionStorage->get('isLogged')) {
            return $this->redirect('\user');
        }
        return $this->render('user\login', ['isError' => $isError]);
    }

    public function actionLogout()
    {
        $sessionStorage = new SessionStorage();
        if($sessionStorage->get('isLogged')) {
            $sessionStorage = new SessionStorage();
            $sessionStorage->clear('isLogged');
            $sessionStorage->clear('attempts');
        }
        return $this->redirect('/user/login');
    }

    public function actionRegister() 
    {
        $sessionStorage = new SessionStorage();
        $userHelper = new UserHelper();
        $request = Kernel::getInstance()->request;
        $userModel = new User();
        if($request->isPost) {
            $userModel->name = $request->getData('post', 'username');
            $userModel->password = $request->getData('post', 'password');
            $userModel->passwordHash = $userHelper->generateHash($userModel->password);
            $userModel->save(false);
        }
        if($request->isGet && $sessionStorage->get('isLogged')) {
            return $this->redirect('\user');
        }
        return $this->render('user\register');
    }
}
