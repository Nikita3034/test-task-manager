<?php

namespace App\Models;

class TaskModel extends Model
{
    private $table_name = 'tasks';

    const STATUS_NOT_DONE = 0;
    const STATUS_DONE = 1;

    const NOT_EDIT = 0;
    const IS_EDIT = 1;

    const NOT_DELETE = 0;
    const IS_DELETE = 1;

    public static function init()
    {
        // database connected
        self::$db = self::dbConnect();

        return new self();
    }

    public function getTasks($sort, $order, $offset, $limit)
    {
        $sql = "SELECT * FROM ?n ?p LIMIT ?i,?i";

        $order_by = 'ORDER BY `'. $sort .'` '. $order;

        return self::$db->getAll(
            $sql,
            $this->table_name,
            $order_by,
            $offset,
            $limit
        );
    }

    public function getCountTasks()
    {
        $sql = "SELECT COUNT(`id`) FROM ?n";

        return self::$db->getOne($sql, $this->table_name);
    }

    public function create($data)
    {
        $sql = "INSERT INTO ?n SET ?u";

        self::$db->query($sql, $this->table_name, $data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE ?n SET ?u WHERE `id` = ?i";

        self::$db->query($sql, $this->table_name, $data, $id);
    }

    public function getTaskById($id)
    {
        $sql = "SELECT * FROM ?n WHERE `id` = ?s";

        return self::$db->getRow($sql, $this->table_name, $id);
    }
}