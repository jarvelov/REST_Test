var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.addUserFormHide = true;
        $scope.getUserFormHide = true;

        $scope.progressHide = true;

        $scope.addUserForm = function() {
            $scope.addUserFormHide = !$scope.addUserFormHide;
        }

        $scope.getUserForm = function() {
            $scope.getUserFormHide = !$scope.getUserFormHide;
        }
    }
);