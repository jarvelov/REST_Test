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

        $scope.addUserForm = function() {
            jQuery('#addUserForm').show();
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
