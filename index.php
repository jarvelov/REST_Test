<?php

require 'vendor/autoload.php';
require 'controller/controller.php';
$controller = new RestController();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"></meta>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/angularjs/js/angular.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-xs-4">
            <a id="addUser" class="btn btn-block btn-default" href="#">Add User</a>
        </div>
        <div class="col-xs-4">
            <a id="getUser" class="btn btn-block btn-default" href="#">List All Users</a>
        </div>
        <div class="col-xs-4">
            <a id="getAllUsers" class="btn btn-block btn-default" href="#">List All Users</a>
        </div>
    </div><!-- /.container -->
</body>
</html>

<?php

$controller->start();

?>