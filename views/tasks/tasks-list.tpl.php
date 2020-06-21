<?php

$tasks = $this->model->read();

?>

<div class="col-md-12 mt-4">
    <h4>Список задач</h4>
</div>

<div class="col-md-12">

    <form id="tasks-list-filter">
        <input type="hidden" name="page" value="<?= $_GET['page'] ?? '' ?>">
        <input type="hidden" name="sort" value="<?= $_GET['sort'] ?? '' ?>">
        <input type="hidden" name="order" value="<?= $_GET['order'] ?? '' ?>">

        <table class="table table-bordered table-tasks-list">
            <thead>
                <tr>
                    <th data-name="name">
                        Имя 
                        <a class="sort-tasks-list">
                            <i class="fa fa-sort-<?= $_GET['order'] == 'ASC' && $_GET['sort'] == 'name' ? 'down' : 'up' ?>"></i>
                        </a>
                    </th>
                    <th data-name="email">
                        Email 
                        <a class="sort-tasks-list">
                            <i class="fa fa-sort-<?= $_GET['order'] == 'ASC' && $_GET['sort'] == 'email' ? 'down' : 'up' ?>"></i>
                        </a>
                    </th>
                    <th>
                        Текст 
                    </th>
                    <th data-name="status">
                        Статус 
                        <a class="sort-tasks-list">
                            <i class="fa fa-sort-<?= $_GET['order'] == 'ASC' && $_GET['sort'] == 'status' ? 'down' : 'up' ?>"></i>
                        </a>
                    </th>
                    <th>
                        Отредактировано 
                    </th>
                    <?php if ($this->isAdmin()) { ?>
                        <th></th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tasks as $key => $item) { ?>
                    <tr data-id="<?= $item['ID'] ?>">
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td>
                            <?php if ($this->isAdmin()) { ?>
                                <input type="text" name="text" value="<?= $item['text'] ?>">
                            <?php } else { ?>
                                <?= $item['text'] ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($this->isAdmin()) { ?>
                                <select class="btn-update-task-status" name="status">
                                    <?php foreach ($this->model->status_array as $k => $i) { ?>
                                        <option value="<?= $k ?>" <?= $item['status'] == $k ? 'selected' : ''?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            <?php } else { ?>
                                <?= $this->model->status_array[$item['status']] ?>
                            <?php } ?>
                        <td><?= $this->model->edit_array[$item['edit']] ?></td>
                        <?php if ($this->isAdmin()) { ?>
                            <td>
                                <button class="btn btn-info btn-update-task-text">Изменить</button>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </form>

    <!-- Пагинация -->
    <?= $this->getPagination($this->model->getCountAllTasks(), $this->model::limit, 'tasks-list-filter') ?>

</div>