<?php

require 'vendor/autoload.php';
require 'controller/controller.php';
require 'controller/database.php';
require 'controller/dbconnection.php';
require 'model/model.php';

$controller = new RestController();
$controller->start();

?>