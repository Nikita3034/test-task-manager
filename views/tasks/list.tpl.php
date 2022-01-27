<?php

$tasks = self::$controller->read();

?>

<div class="col-md-12 mt-4">
    <h4>Task list</h4>
</div>

<div class="col-md-12">

    <?php if (empty($tasks)) { ?>
        <div>No tasks</div>
    <?php } else { ?>
        <form id="tasks-list-filter">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?? '' ?>">
            <input type="hidden" name="sort" value="<?= $_GET['sort'] ?? '' ?>">
            <input type="hidden" name="order" value="<?= $_GET['order'] ?? '' ?>">

            <table class="table table-bordered table-tasks-list">
                <thead>
                    <tr>
                        <th data-name="name">
                            Username 
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
                            Text 
                        </th>
                        <th data-name="status">
                            Status 
                            <a class="sort-tasks-list">
                                <i class="fa fa-sort-<?= $_GET['order'] == 'ASC' && $_GET['sort'] == 'status' ? 'down' : 'up' ?>"></i>
                            </a>
                        </th>
                        <th>
                            Edited 
                        </th>
                        <?php if (self::$controller->userController->isAdmin()) { ?>
                            <th></th>
                        <?php } ?>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tasks as $key => $item) { ?>
                        <tr data-id="<?= $item['id'] ?>">
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['email'] ?></td>
                            <td>
                                <?php if (self::$controller->userController->isAdmin()) { ?>
                                    <input type="text" name="text" value="<?= $item['text'] ?>">
                                <?php } else { ?>
                                    <?= $item['text'] ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if (self::$controller->userController->isAdmin()) { ?>
                                    <input class="form-check-input" 
                                        name="status"
                                        type="checkbox" 
                                        value="0" 
                                        id="flexCheckDefault-<?=$key?>"
                                        <?= $item['status'] == 1 ? 'checked' : ''?>>
                                    <label class="form-check-label" for="flexCheckDefault-<?=$key?>">
                                        <?= $item['status'] == 1 ? 'done' : 'not done'?>
                                    </label>
                                <?php } else { ?>
                                    <?= $item['status'] == 1 ? 'done' : 'not done'?>
                                <?php } ?>
                            <td>
                                <?= $item['edit'] == 1 ? 'edited by admin' : 'not edited'?>
                            </td>
                            <?php if (self::$controller->userController->isAdmin()) { ?>
                                <td>
                                    <button class="btn btn-info btn-update-task-text">Edit</button>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </form>
    <?php } ?>

    <?= $this->getPagination(self::$controller->getCountTasks(), 'tasks-list-filter') ?>

</div>