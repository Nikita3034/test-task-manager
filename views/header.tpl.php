<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Tasks</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="/libraries/fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/server.js"></script>
</head>
<body>

    <?php if (self::$url != '/users/login') {
        if ($this->isAuth()) { ?>

            <div class="container">
                <div class="col-md-12 mt-4 text-right">
                    <button class="btn btn-danger btn-user-logout">Выход</button>
                </div>
            </div>

        <?php } else { ?>

            <div class="container">
                <div class="col-md-12 mt-4 text-right">
                    <a href="/users/login" class="btn btn-success">Вход</a>
                </div>
            </div>
            
        <?php } ?>
    <?php } ?>