<?php

require 'vendor/autoload.php';
require 'controller/controller.php';
require 'controller/database.php';
require 'controller/databasecontroller.php';

$controller = new RestController();
$controller->start();

?>