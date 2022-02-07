<?php

use Invoke\Invoke;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$methods = require_once("config/methods.php");
$config = require_once("config/invoke.php");

Invoke::setup(
    $methods,
    $config
);

Invoke::serve();
