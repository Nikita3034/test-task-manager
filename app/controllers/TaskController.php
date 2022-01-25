<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Models\TaskModel;
use App\Models\TaskStatusModel;
use App\Models\TaskEditModel;

class TaskController
{
    use \App\Traits\StringTrait;
    use \App\Traits\PaginationTrait;

    private $mainController;
    public $userController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        $this->userController = new UserController($this->mainController);
    }

    /**
     * Print current page
     *
     * @return void
     */
    public function view()
    {
        $this->mainController->print('tasks');
    }

    /**
     * Get list tasks
     *
     * @return array
     */
    public function read(): array
    {
        $page = !empty($_GET['page']) ? $_GET['page'] : 0;
        $sort = !empty($_GET['sort']) ? $_GET['sort'] : 'ID';
        $order = !empty($_GET['order']) ? $_GET['order'] : 'DESC';

        $offset = $page * $this->limit;

        return TaskModel::init()->getTasks($sort, $order, $offset, $this->limit);
    }

    /**
     * Create task
     *
     * @return boolean
     */
    public function create(): bool
    {
        $data = [
            'name' => $this->clearString($_POST['name']),
            'email' => $this->clearString($_POST['email']),
            'text' => $this->clearString($_POST['text']),
            'status' => TaskModel::DEFAULT_STATUS,
            'edit' => TaskModel::NOT_EDIT,
            'delete' => TaskModel::NOT_DELETE
        ];

        TaskModel::init()->create($data);

        return true;
    }

    /**
     * Update task
     *
     * @return boolean
     */
    public function update(): bool
    {
        if (!$this->userController->isAdmin()) {
            return false;
        }

        $status = !empty($this->getStatuses()[$_POST['status']]) ? $_POST['status'] : TaskModel::DEFAULT_STATUS;

        $data = [
            'text' => $this->clearString($_POST['text']),
            'status' => $status,
            'edit' => TaskModel::IS_EDIT,
        ];

        TaskModel::init()->update($_POST['id'], $data);

        return true;
    }

    /**
     * Delete task
     *
     * @return boolean
     */
    public function delete()
    {
        if (!$this->userController->isAdmin()) {
            return false;
        }

        TaskModel::init()->update($_POST['id'], ['delete' => TaskModel::IS_DELETE]);

        return true;
    }

    /**
     * Get task statuses
     *
     * @return array
     */
    public function getStatuses(): array
    {
        $statuses = [];

        $data = TaskStatusModel::init()->getStatuses();

        foreach ($data as $item) {
            $statuses[$item['ID']] = $item['name'];
        }

        return $statuses;
    }

    /**
     * Get task edit statuses
     *
     * @return array
     */
    public function getEdits(): array
    {
        $edits = [];

        $data = TaskEditModel::init()->getEdits();

        foreach ($data as $item) {
            $edits[$item['ID']] = $item['name'];
        }

        return $edits;
    }

    /**
     * Get count all not deleted tasks
     *
     * @return integer
     */
    public function getCountTasks(): int
    {
        return (int) TaskModel::init()->getCountTasks();
    }
}