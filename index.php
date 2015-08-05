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
    <link rel="stylesheet" href="css/main.css">
    <script src="lib/jquery/js/jquery.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/angularjs/js/angular.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <div class="container" ng-controller="mainController">
        <div id="option-container" class="row">
            <div class="col-xs-12">
                <h3>Options</h3>
            </div>
            <div class="col-xs-4">
                <button id="addUser" class="btn btn-block btn-default" ng-click="formAddUser()">Add User</button>
            </div>
            <div class="col-xs-4">
                <button id="getUser" class="btn btn-block btn-default" ng-click="formGetUser()">Get A User</button>
            </div>
            <div class="col-xs-4">
                <button id="getAllUsers" class="btn btn-block btn-default" ng-click="getAllUsers()">Get All Users</button>
            </div>
        </div><!-- /#option-container -->

        <div id="parameter-container" class="row">
            <div class="col-xs-12">
                <h3>Extra parameters</h3>
            </div>
            <div id="addUserForm" class="col-xs-12" ng-hide="hideAddUserForm">
                <input ng-model="name" type="text" class="form-control" placeholder="Name" />
                <input ng-model="username" type="text" class="form-control" placeholder="Username" />
                <input ng-model="password" type="password" class="form-control" placeholder="Name" />
                <input ng-model="email" type="email" class="form-control" placeholder="E-mail" />
            </div><!-- /#addUserForm -->
            <div id="getUserForm" class="col-xs-12" ng-hide="hideGetUserForm">
                <input ng-model="username" type="text" class="form-control" placeholder="Username" />
            </div><!-- /#getUserForm -->
        </div><!-- /#parameter-container -->

        <div id="action-container" class="row">
            <div class="col-xs-12">
                <button class="btn btn-block btn-primary {{formAction === false ? 'disabled' : '' }} ">{{formAction === false ? "Select action up top!" : "Run action : " + formAction}}</button>
            </div>
        </div>

        <div id="result-container" class="row">
            <div id="result-title" class="col-xs-12">
                <h3>Results show here:</h3>
            </div><!-- /#result-title -->
            <div id="progress-container" class="col-xs-12" ng-hide="progressHide">
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