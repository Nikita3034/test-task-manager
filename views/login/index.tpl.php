<div class="container">

    <div class="col-md-12 mt-4 text-center">
        <h2>Страница входа</h2>
    </div>

    <?php if (self::$controller->isAuth()) { ?>

        <div class="col-md-12 mt-4">
            <h4>Вы уже вошли</h4>
        </div>

        <div class="col-md-12 mt-4">
            <a href="/" class="btn btn-info">Вернуться на главную</a>
        </div>

    <?php } else { ?>

        <form class="ajax-form-submit" action="/api/auth/login" method="POST">
            <div class="col-md-12">
                <div class="col-md-3 center-block">
                    <label for="form-login">Логин</label>
                    <input type="text" class="form-control" id="form-login" name="login" value="" autocomplete="off" required>
                </div>

                <div class="col-md-3 center-block">
                    <label for="form-password">Пароль</label>
                    <input type="password" class="form-control" id="form-password" name="password" value="" autocomplete="off" required>
                </div>

                <div class="col-md-3 center-block mt-2 text-right">
                    <button class="btn btn-info" type="submit">Войти</button>
                </div>
            </div>
        </form>
    <?php } ?>
</div>