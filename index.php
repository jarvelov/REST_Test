<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require 'vendor/autoload.php';
require 'controller/controller.php';
require 'controller/database.php';
require 'controller/databasecontroller.php';

$controller = new RestController();
$controller->start();

?>