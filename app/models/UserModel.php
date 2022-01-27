<?php

namespace App\Models;

class UserModel extends Model
{
    private $table_name = 'users';

    const ADMIN_ROLE = 1;

    public static function init()
    {
        // database connected
        self::$db = self::dbConnect();

        return new self();
    }

    public function getUserByLoginPass($login, $password)
    {
        $sql = "SELECT `id` FROM ?n WHERE `login` = ?s AND `password` = ?s";

        return self::$db->getOne($sql, $this->table_name, $login, $password);
    }

    public function getUserByIdHash($id, $hash)
    {
        $sql = "SELECT `id` FROM ?n WHERE `id` = ?i AND `hash` = ?s";

        return self::$db->getOne($sql, $this->table_name, $id, $hash);
    }

    public function checkUserIsAdmin($id)
    {
        $sql = "SELECT `id` FROM ?n WHERE `id` = ?i AND `role` = ?i";

        return self::$db->getOne(
            $sql,
            $this->table_name,
            $id,
            self::ADMIN_ROLE
        );
    }

    public function removeHashUser($id)
    {
        $sql = "UPDATE ?n SET ?u WHERE `id` = ?i";

        self::$db->query(
            $sql,
            $this->table_name,
            ['hash' => ''],
            $id
        );
    }

    public function updateHashUser($id, $hash)
    {
        $sql = "UPDATE ?n SET ?u WHERE `id` = ?i";

        self::$db->query($sql, 'users', ['hash' => $hash], $id);
    }
}