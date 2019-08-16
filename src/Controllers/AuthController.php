<?php

namespace Quiz\Controllers;

use Exception;
use http\Client\Curl\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;
//include_once '../bootstrap.php';
use Illuminate\Database\Capsule\Manager;


/**
 * Class AuthController
 * @package Quiz\Controllers
 * @
 */


use Quiz\Services\UserService;
use Quiz\Session;

$_SESSION['message'] = ' ';

class AuthController extends BaseController
{

    /**
     * @return string
     */
    public function register()
    {
        return $this->view('register');
    }

    public function registerPost()
    {


        $data = $this->input;


        if ($data['password'] !== $data['password_confirmation']) {
            Session::getInstance()->addError('password do not match');

            redirect('/register');

        }
        $userService = new UserService();
        try {
            $user = $userService->registerUser($data);
        } catch (Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/register');


        }
        Session::getInstance()->addMessage('you have succesfuly registered');
        redirect();


    }

    /**
     * @return string
     */
    public function login()
    {

        return $this->view('login');
    }

    public function loginPost()
    {
        $data = $this->input;
        $userService = new UserService();
        try {
            $userService->attemptLogin($data);
            redirect('/');
        } catch (Exception $exception) {
            Session::getInstance()->addError($exception->getMessage());
            redirect('/login');
        }

    }

    public function logout()
    {
        Session::getInstance()->delete(Session::LOGGED_IN_USER);
        return $this->view('login');

    }

    public function showResults()
    {

        return $this->view('results');
    }
   

}
