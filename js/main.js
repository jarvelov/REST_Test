var REST = angular.module("REST", []);

REST.controller(
    "optionController",
    function($scope) {
        //Code here
    }
);

REST.controller(
    "addUserController",
    function($scope) {
        //Code here
        $scope.addUserFormHide = true;
        $scope.getUserFormHide = true;
        $scope.progressHide = true;

        $scope.addUserForm = function() {
            $scope.addUserFormHide = !$scope.addUserFormHide;
        }

        $scope.addUserForm = function() {
            return 'addUserForm';
        }
    }
);

REST.controller(
    "getUserController",
    function($scope) {
        //Code here
    }
);
