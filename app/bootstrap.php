<?php
defined('APP_PATH') || define('APP_PATH', __DIR__);
defined('ROOT_PATH') || define('ROOT_PATH', dirname(APP_PATH));

// Autoloader
require_once ROOT_PATH.'/vendor/autoload.php';

// Init Slim
$c = new Slim\Container(include APP_PATH.'/config/slim/settings.php');
$app = new Slim\App($c);

require_once APP_PATH.'/config/slim/dependencies.php';
require_once APP_PATH.'/config/slim/middleware.php';
require_once APP_PATH.'/config/slim/routes.php';

// Run!
$app->run();
