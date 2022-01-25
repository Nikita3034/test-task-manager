<div class="col-md-12">
    <h4>Форма создания задачи</h4>
</div>

<form class="ajax-form-submit" action="/api/task/create" method="POST">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <label for="form-name">Имя пользователя</label>
                <input type="text" class="form-control" id="form-name" name="name" value="" autocomplete="off" required>
            </div>

            <div class="col-md-3">
                <label for="form-email">Email пользователя</label>
                <input type="email" class="form-control" id="form-email" name="email" value="" autocomplete="off" required>
            </div>

            <div class="col-md-3">
                <label for="form-text">Текст задачи</label>
                <input type="text" class="form-control" id="form-text" name="text" value="" autocomplete="off" required>
            </div>

            <div class="col-md-3">
                <button class="btn btn-info btn-submit-task" type="submit">Добавить</button>
            </div>
        </div>
    </div>
</form>