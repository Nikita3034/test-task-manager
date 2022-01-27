<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\UserModel;

class AuthController
{
    use \App\Traits\StringTrait;

    private $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
    }

    /**
     * Print current page
     *
     * @return void
     */
    public function view()
    {
        $this->mainController->print('login');
    }

    /**
     * Log in on site
     *
     * @return boolean
     */
    public function login(): bool
    {
        // data validation
        if (
            empty($_POST['login']) ||
            empty($_POST['password'])
        ) {
            return false;
        }

        $login = $this->clearString($_POST['login']);
        $password = md5(md5($_POST['password'] .'_gimeaccess'));

        $user_id = UserModel::init()->getUserByLoginPass($login, $password);

        if (empty($user_id)) {
            return false;
        }

        $hash = md5('user_'. $user_id .'_givemeaccess');

        UserModel::init()->updateHashUser($user_id, $hash);

        $cookie_time = time() + 60 * 60 * 24;

        setcookie('user_id', $user_id, $cookie_time, "/");
        setcookie('user_hash', $hash, $cookie_time, "/", null, null, true);

        return true;
    }

    /**
     * Log out from site
     *
     * @return boolean
     */
    public function logout(): bool
    {
        if (empty($_COOKIE['user_id'])) {
            return false;
        }

        UserModel::init()->removeHashUser($_COOKIE['user_id']);

        setcookie('user_id', '', 0, "/");
        setcookie('user_hash', '', 0, "/", null, null, true);

        return true;
    }

    /**
     * Check if auth user
     *
     * @return boolean
     */
    public function isAuth(): bool
    {
        if (!empty($_COOKIE['user_id']) && !empty($_COOKIE['user_hash'])) {

            $result = UserModel::init()->getUserByIdHash($_COOKIE['user_id'], $_COOKIE['user_hash']);

            return !empty($result) ? true : false;
        } else
            return false;
    }
}