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
            <div id="error-container" class="row">
                <div id="errors" class="col-xs-12">
                    <?php
                        if(isset($errors)) {
                            foreach($errors as $error) {
                                echo '<div id="error" class="alert alert-danger"><strong>Error!</strong>' . $error . '</div>';
                            }
                        }
                    ?>
                </div>
            </div><!-- /#error-container -->
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

            <div id="parameter-container" class="row">
                <div class="col-xs-12">
                    <h3>Required parameters</h3>
                    <div class="alert alert-info" ng-hide="hideInfo"><span class="glyphicon glyphicon-exclamation-sign"></span> Click any of the buttons up top to continue.</div>
                </div>
                <div class="form-container" ng-repeat="form in Forms">
                    <form id="{{form.name}}" ng-hide="form.functions.isHidden()" ng-submit="sendPost()">
                        <div class="form-group col-xs-12" ng-repeat="input in form.inputs">
                            <label for="{{input.label}}">{{input.label}}</label>
                            <input id="{{input.label}}" type="{{input.type}}" class="form-control" ng-model="inputs[input.slug]" ng-pattern="input.pattern" name="{{input.label}}" />
                        </div><!-- /.form-group -->
                        <div id="action-button" class="col-xs-12">
                            <input type="submit" class="btn btn-block btn-primary" value="{{form.action}}" />
                        </div><!-- /#action-button -->
                    </form><!-- /form -->
                </div>
            </div><!-- /#parameter-container -->

            <div id="result-container" class="row">
                <div id="result-title" class="col-xs-12">
                    <h3>Results</h3>
                    <div class="alert alert-info" ng-hide="hideInfo"><span class="glyphicon glyphicon-exclamation-sign"></span> Results will show here.</div>
                </div><!-- /#result-title -->
                <div id="progress-container" class="col-xs-12" ng-hide="hideProgress">
                    <div class="progress">
                        <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar" ng-style="{width : ( progressPercentage + '%' ) }">
                        </div><!-- /#progressbar -->
                    </div><!-- /.progress -->
                </div><!-- /#progress-container -->
                <div class="col-xs-12">
                    <div class="alert alert-{{result.alert}}" ng-show="result.show"><span class="glyphicon glyphicon-exclamation-sign"></span> {{result.message}}</div>
                    <table class="table table-striped table-hover table-bordered" ng-if="result.status">
                        <thead>
                            <tr style="text-transform:uppercase">
                                <th ng-repeat="(key, value) in result.data[0]">{{key}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="row in result.data">
                                <td ng-repeat="cell in row">{{cell}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </body>
</html>