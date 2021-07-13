<?php

use Invoke\InvokeMachine;

require_once dirname(__DIR__) . "/vendor/autoload.php";

$functions = require_once("config/functions.php");

InvokeMachine::setup($functions);

InvokeMachine::handleRequest();
