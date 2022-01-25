<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController
{
    /**
     * Check auth user is admin
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_hash'])) {

            $result = UserModel::init()->checkUserIsAdmin($_COOKIE['user_id']);

            return !empty($result) ? true : false;
        } else
            return false;
    }
}