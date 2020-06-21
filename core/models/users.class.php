<?php

class Users extends Main {

    public function __construct() {

        $url = explode('/', self::$url);

        if (!empty($url[2]))
            self::$view = $url[2];
    }

    public function login() {

        $input = $_POST;

        $name = $input['login'];
        $password = md5(md5($input['password'] .'_gimeaccess'));

        $db = $this->getDB();

        $sql = "SELECT * FROM ?n WHERE `name` = ?s AND `password` = ?s";

        $result = $db->getOne($sql, 'users', $name, $password);

        if (empty($result))
            return false;

        $cookie_time = time() + 60 * 2;

        $hash = md5('user_'. $result .'_givemeaccess');

        $db = $this->getDB();

        $sql = "UPDATE ?n SET ?u WHERE `ID` = ?i";

        $db->query($sql, 'users', ['hash' => $hash], $result);

        setcookie('user_id', $result, $cookie_time, "/");
        setcookie('user_hash', $hash, $cookie_time, "/", null, null, true);

        return true;
    }

    public function logout() {

        setcookie('user_id', '', time() - 3600*24*30*12, "/");
        setcookie('user_hash', '', time() - 3600*24*30*12, "/", null, null, true);

        return true;
    }
}