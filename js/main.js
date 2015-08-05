var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.formAddUser = function() {
            $scope.reset();
            $scope.hideAddUserForm = !$scope.hideAddUserForm;
        }

        $scope.formGetUser = function() {
            $scope.reset();
            $scope.hideGetUserForm = !$scope.hideGetUserForm;
        }

        $scope.reset = function() {
            $scope.hideAddUserForm = true;
            $scope.hideGetUserForm = true;
            $scope.progressHide = true;
        }

        $scope.reset();
    }
);