<?php

namespace App\Models;

class TaskModel extends Model
{
    private $table_name = 'tasks';

    const DEFAULT_STATUS = 1;

    const NOT_EDIT = 2;
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
        $sql = "SELECT * FROM ?n WHERE `delete` != ?i ?p LIMIT ?i,?i";

        $order_by = 'ORDER BY `'. $sort .'` '. $order;

        return self::$db->getAll(
            $sql,
            $this->table_name,
            self::IS_DELETE,
            $order_by,
            $offset,
            $limit
        );
    }

    public function getCountTasks()
    {
        $sql = "SELECT COUNT(*) FROM ?n WHERE `delete` != ?i";

        return self::$db->getOne($sql, $this->table_name, self::IS_DELETE);
    }

    public function create($data)
    {
        $sql = "INSERT INTO ?n SET ?u";

        self::$db->query($sql, $this->table_name, $data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE ?n SET ?u WHERE `ID` = ?i";

        self::$db->query($sql, $this->table_name, $data, $id);
    }
}