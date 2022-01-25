<?php
// autoload classes
spl_autoload_register(function ($class) {
    $path = str_replace("\\", "/", $class);
    require_once $path .".php";
});

define('DIR_PATH', realpath(__DIR__ .'/../'));
define('APP_PATH', DIR_PATH .'/app');
define('LIBRARY_PATH', APP_PATH .'/libraries');
define('CONTROLLER_PATH', APP_PATH .'/controllers');
define('VIEWS_PATH', DIR_PATH .'/views');

// load routes
require_once APP_PATH .'/route.php';

// load env variables
(new App\Libraries\DotEnv(DIR_PATH . '/.env'))->load();

$main = new App\Controllers\MainController($route);