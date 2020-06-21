<?php

class Tasks extends Main {

    CONST limit = 3;

    private $page = 0;
    private $sort = 'ID';
    private $order = 'DESC';

    protected $status_array = [
        0 => 'Не выполнена',
        1 => 'Выполнена'
    ];

    protected $edit_array = [
        0 => 'Не отредактированная',
        1 => 'Отредактирована администратором'
    ];

    public function read():array {

        $list = [];

        if (!empty($_GET['page']))
            $this->page = $_GET['page'];

        if (!empty($_GET['sort']))
            $this->sort = $_GET['sort'];

        if (!empty($_GET['order']))
            $this->order = $_GET['order'];

        $offset = $this->page * self::limit;

        $db = $this->getDB();

        $sql = "SELECT * FROM ?n ?p LIMIT ?i,?i";

        $order_by = 'ORDER BY `'. $this->sort .'` '. $this->order;

        $list = $db->getAll($sql, 'tasks', $order_by, $offset, self::limit);

        return $list;
    }

    protected function create():bool {

        $input = $_POST;

        $add_array = [
            'name' => $input['name'],
            'email' => $input['email'],
            'text' => $input['text'],
            // status по умолчанию выставляется 0
            // edit по умолчанию выставляется 0
        ];

        foreach ($add_array as &$item)
            $item = $this->cleanString($item);

        $db = $this->getDB();

        $sql = "INSERT INTO ?n SET ?u";

        $db->query($sql, 'tasks', $add_array);

        return true;
    }

    protected function update():bool {

        if (!$this->isAdmin())
            return false;

        $input = $_POST;

        $status = !empty($this->status_array[$input['status']]) ? $input['status'] : 0;

        $update_array = [
            'text' => $this->cleanString($input['text']),
            'status' => $status,
            'edit' => 1
        ];

        $db = $this->getDB();

        $sql = "UPDATE ?n SET ?u WHERE `ID` = ?i";

        $db->query($sql, 'tasks', $update_array, $input['id']);

        return true;
    }

    protected function getCountAllTasks():int {

        $db = $this->getDB();

        $sql = "SELECT COUNT(*) FROM ?n";

        $count = (int) $db->getOne($sql, 'tasks');

        return $count;
    }
}