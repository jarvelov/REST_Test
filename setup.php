<?php

require 'controller/database.php';
require 'controller/dbconnection.php';

$db = new Database( DatabaseController::DBPATH );
$db->createDatabase();

?>