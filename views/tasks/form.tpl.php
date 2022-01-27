<div class="col-md-12">
    <h4>Creating a task</h4>
</div>

<form class="ajax-form-submit" action="/api/task/create" method="POST">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <label for="form-name">Username</label>
                <input type="text" 
                    class="form-control" 
                    id="form-name" 
                    name="name" 
                    value="" 
                    autocomplete="off" 
                    required>
            </div>

            <div class="col-md-3">
                <label for="form-email">Email</label>
                <input type="email" 
                    class="form-control" 
                    id="form-email" 
                    name="email" 
                    value="" 
                    autocomplete="off" 
                    required>
            </div>

            <div class="col-md-3">
                <label for="form-text">Task text</label>
                <input type="text" 
                    class="form-control" 
                    id="form-text" 
                    name="text" 
                    value="" 
                    autocomplete="off" 
                    required>
            </div>

            <div class="col-md-3">
                <button class="btn btn-primary btn-submit-task" type="submit">Add</button>
            </div>
        </div>
    </div>
</form>