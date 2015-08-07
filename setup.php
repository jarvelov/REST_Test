<?php

require 'controller/database.php';
require 'controller/dbconnection.php';

$db = new Database( DatabaseConnection::DBPATH );
$db->createDatabase();

?>