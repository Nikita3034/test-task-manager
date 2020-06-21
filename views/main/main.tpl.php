<div class="container">

    <div class="col-md-12 mt-4 text-center">
        <h2>Главная страница</h2>
    </div>

    <?php

    $this->initClass('tasks');

    require_once VIEWS_PATH .'/tasks/tasks.tpl.php';
    
    ?>
</div>