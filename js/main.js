var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.formAddUser = function() {
            $scope.reset();

            $scope.hideParameter = false;
            $scope.formAction = 'Add user!';
            $scope.hideAddUserForm = !$scope.hideAddUserForm;
        }

        $scope.formGetUser = function() {
            $scope.reset();

            $scope.hideParameter = false;
            $scope.formAction = 'Get user!';
            $scope.hideGetUserForm = !$scope.hideGetUserForm;
        }

        $scope.getAllUsers = function() {
            $scope.reset();
            $scope.formAction = 'Get all users!';
        }

        $scope.reset = function() {
            $scope.formAction = false;
            $scope.hideAddUserForm = true;
            $scope.hideGetUserForm = true;
            $scope.hideParameter = true;
            $scope.hideProgress = true;
        }

        $scope.reset();
    }
);