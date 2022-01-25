<?php

namespace App\Models;

class TaskEditModel extends Model
{
    private $table_name = 'task_edits';

    public static function init()
    {
        // database connected
        self::$db = self::dbConnect();

        return new self();
    }

    public function getEdits()
    {
        $sql = "SELECT * FROM ?n";

        return self::$db->getAll($sql, $this->table_name);
    }
}