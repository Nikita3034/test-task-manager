<?php

namespace App\Models;

class TaskStatusModel extends Model
{
    private $table_name = 'task_statuses';

    public static function init()
    {
        // database connected
        self::$db = self::dbConnect();

        return new self();
    }

    public function getStatuses()
    {
        $sql = "SELECT * FROM ?n";

        return self::$db->getAll($sql, $this->table_name);
    }
}