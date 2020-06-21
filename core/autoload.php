<?php

define('DIR_PATH', realpath(__DIR__.'/../'));
define('CORE_PATH', DIR_PATH.'/core');
define('MODEL_PATH', CORE_PATH.'/models');
define('VIEWS_PATH', DIR_PATH.'/views');

require_once MODEL_PATH .'/main.class.php';

$main = new Main();
$main->load();