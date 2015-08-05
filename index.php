<?php

require 'vendor/autoload.php';
require 'controller/controller.php';
$controller = new RestController();
?>

<!DOCTYPE html>
<html ng-app="REST">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/angularjs/js/angular.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container">
        <div id="option-container" class="row" ng-controller="optionController">
            <div class="col-xs-4">
                <button id="addUser" class="btn btn-block btn-default" ng-click"addUserForm()">Add User</button>
            </div>
            <div class="col-xs-4">
                <button id="getUser" class="btn btn-block btn-default" ng-click="getUserForm()">Get A User</button>
            </div>
            <div class="col-xs-4">
                <button id="getAllUsers" class="btn btn-block btn-default" ng-click="getAllUsers()">Get All Users</button>
            </div>
        </div><!-- /#option-container -->

        <div id="action-container" class="row hidden">
            <div id="addUserForm" class="col-xs-12" ng-controller="addUserController">
                <input ng-model="name" type="text" class="form-control" placeholder="Name" />
                <input ng-model="username" type="text" class="form-control" placeholder="Username" />
                <input ng-model="password" type="password" class="form-control" placeholder="Name" />
                <input ng-model="email" type="email" class="form-control" placeholder="E-mail" />
            </div><!-- /#addUserForm -->
            <div id="getUserForm" class="col-xs-12" ng-controller="getUserController">
                <input ng-model="username" type="text" class="form-control" placeholder="Username" />
            </div><!-- /#getUserForm -->
        </div><!-- /#action-container -->

        <div id="result-container" class="row">
            <h3>Results show here:</h3>
            <div id="progress-container" class="col-xs-12 hidden">
                <div class="progress">
                    <div id="progressbar" class="progress-bar" role="progressbar">
                    </div><!-- /#progressbar -->
                </div><!-- /.progress -->
            </div><!-- /#progress-container -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</body>
</html>

<?php

$controller->start();

?>