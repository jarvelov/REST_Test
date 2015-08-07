<?php

require 'vendor/autoload.php';
require 'controller/controller.php';
require 'model/model.php';

$controller = new RestController();
$controller->start();

?>