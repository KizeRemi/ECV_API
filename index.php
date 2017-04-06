<?php
require_once("vendor/autoload.php");

use Silex\Application;

$app = new Application();
$app['debug'] = true;

require_once("bootstrap.php");
require_once("app/api_routes.php");

$app->run();