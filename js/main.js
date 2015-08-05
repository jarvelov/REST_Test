var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.formAddUser = function() {
            $scope.reset();
            $scope.formAction = 'Add user!';
            $scope.hideAddUserForm = !$scope.hideAddUserForm;
        }

        $scope.formGetUser = function() {
            $scope.reset();
            $scope.formAction = 'Get user!';
            $scope.hideGetUserForm = !$scope.hideGetUserForm;
        }

        $scope.reset = function() {
            $scope.formAction = false;
            $scope.hideAddUserForm = true;
            $scope.hideGetUserForm = true;
            $scope.progressHide = true;
        }

        $scope.reset();
    }
);