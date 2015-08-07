<?php

Class Model {
    function __construct() {
        $this->options = [];
    }
}

 ?>

<!DOCTYPE html>
<html ng-app="REST">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>REST test</title>
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="lib/jquery/js/jquery.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="lib/angularjs/js/angular.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
        <div class="container" ng-controller="mainController">
            <div id="option-container" class="row" >
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

            <div id="parameter-container" class="row" ng-hide="hideParameter">
                <div class="col-xs-12">
                    <h3>Required parameters</h3>
                </div>
                <div class="form-container" ng-repeat="form in Forms">
                    <form id="{{form.name}}" ng-hide="form.functions.isHidden()">
                        <div class="form-group col-xs-12" ng-repeat="input in form.inputs">
                            <label for="{{input.label}}">{{input.label}}</label>
                            <input id="{{input.label}}" type="{{input.type}}" class="form-control" ng-pattern="input.pattern" name="{{input.label}}" />
                        </div>
                    </form>
                    <div class="col-xs-12">
                        <button class="btn btn-block btn-primary">{{form.action}}</button>
                    </div>
                </div>
            </div><!-- /#parameter-container -->

            <div id="result-container" class="row">
                <div id="result-title" class="col-xs-12">
                    <h3>Results</h3>
                </div><!-- /#result-title -->
                <div id="progress-container" class="col-xs-12" ng-hide="hideProgress">
                    <div class="progress">
                        <div id="progressbar" class="progress-bar" role="progressbar">
                        </div><!-- /#progressbar -->
                    </div><!-- /.progress -->
                </div><!-- /#progress-container -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </body>
</html>
