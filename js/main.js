var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.hideAddUserForm = true;
        $scope.hideGetUserForm = true;

        $scope.progressHide = true;

        $scope.addUserForm = function() {
            console.log('debug');
            $scope.hideAddUserForm = !$scope.hideAddUserForm;
        }

        $scope.getUserForm = function() {
            $scope.hideGetUserForm = !$scope.hideGetUserForm;
        }
    }
);