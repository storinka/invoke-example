<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Pipes\CycleOrmPipe;
use App\Pipes\HandleCors;
use App\Providers\RepositoriesProvider;
use Invoke\Invoke;
use Invoke\Pipeline;
use Invoke\Pipes\EmitResponse;
use Invoke\Pipes\HandleRequest;
use Invoke\Pipes\ParseRequest;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$methods = require_once("config/methods.php");
$invokeConfig = require_once("config/invoke.php");
$databaseConfig = require_once("config/database.php");

Pipeline::pass(CycleOrmPipe::class, $databaseConfig);
Pipeline::pass(RepositoriesProvider::class);

Invoke::setup(
    $methods,
    $invokeConfig
);

try {
    Invoke::serve([
        HandleCors::class,
        ParseRequest::class,
        HandleRequest::class,
        EmitResponse::class
    ]);
} catch (Throwable $exception) {
    invoke_dd($exception);
}