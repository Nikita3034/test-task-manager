<?php if ($this->authContoller->isAuth()) { ?>

    <div class="container">
        <div class="col-md-12 mt-4 text-right">
            <button class="btn btn-danger btn-user-logout">Exit</button>
        </div>
    </div>

<?php } else { ?>

    <div class="container">
        <div class="col-md-12 mt-4 text-right">
            <a href="/login" class="btn btn-success">Login</a>
        </div>
    </div>

<?php } ?>