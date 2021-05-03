<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

use Reflect\InvokeApp;
use Reflect\Providers\AppProvider;

require_once "vendor/autoload.php";

$functions = require_once("config/functions.php");

$app = new InvokeApp($functions);

$app->provide(AppProvider::class);

$app->run();
