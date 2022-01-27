<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Controllers\UserController;
use App\Models\TaskModel;

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
        $sort = !empty($_GET['sort']) ? $_GET['sort'] : 'id';
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
        // data validation
        if (
            empty($_POST['name']) ||
            empty($_POST['email']) ||
            empty($_POST['text'])
        ) {
            return false;
        }

        // preparing data
        $data = [
            'name' => $this->clearString($_POST['name']),
            'email' => $this->clearString($_POST['email']),
            'text' => $this->clearString($_POST['text']),
            'status' => TaskModel::STATUS_NOT_DONE,
            'edit' => TaskModel::NOT_EDIT,
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

        // data validation
        if (
            empty($_POST['id']) ||
            empty($_POST['text'])
        ) {
            return false;
        }

        // preparing data
        $data = [
            'text' => $this->clearString($_POST['text']),
            'status' => $_POST['status'] == 1 ? TaskModel::STATUS_DONE : TaskModel::STATUS_NOT_DONE,
        ];

        $task = $this->getTaskById($_POST['id']);

        // if text changed - task is edited by admin
        if ($task['text'] != $_POST['text']) {
            $data['edit'] = TaskModel::IS_EDIT;
        }

        TaskModel::init()->update($_POST['id'], $data);

        return true;
    }

    /**
     * Get task by id
     *
     * @param [type] $id
     * @return array
     */
    private function getTaskById($id): array
    {
        return TaskModel::init()->getTaskById($id);
    }

    /**
     * Get count all tasks
     *
     * @return integer
     */
    public function getCountTasks(): int
    {
        return (int) TaskModel::init()->getCountTasks();
    }
}