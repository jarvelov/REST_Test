var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope) {
        $scope.formAddUser = function() {
            $scope.reset();

            $scope.hideParameter = false;
            $scope.Forms.AddUser.hide = false;
        }

        $scope.formGetUser = function() {
            $scope.reset();

            $scope.hideParameter = false;
            $scope.Forms.GetUser.hide = false;
        }

        $scope.getAllUsers = function() {
            $scope.reset();
            $scope.formAction = 'Get all users!';
        }

        $scope.reset = function() {
            $scope.formAction = false;

            $scope.Forms = {
                AddUser:{
                    name:"add_user",
                    action:"Add User!",
                    hide:true,
                    inputs:{
                        name:{
                            type:"text",
                            label:"Name",
                            errorMessage:""
                        },
                        username:{
                            pattern:"[A-Za-z0-9]{0,10}",
                            type:"text",
                            label:"Username",
                            errorMessage:"Username can only consist of letters and digits and must be less than 10 characters!"
                        },
                        password:{
                            pattern:"[A-Za-z0-9]",
                            type:"password",
                            label:"Password",
                            errorMessage:"Password can only consist of letters and digits!"
                        },
                        email:{
                            pattern:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}",
                            type:"email",
                            label:"E-mail",
                            errorMessage:"Invalid format of E-mail adress!"
                        }
                    }
                },
                GetUser:{
                    name:"get_user",
                    action:"Get User!",
                    hide:true,
                    inputs:{
                        username:{
                            pattern:"[A-Za-z0-9]{0,10}",
                            label:"Username"
                        }
                    }
                }
            };

            $scope.hideParameter = true;
            $scope.hideProgress = true;
        }

        $scope.reset();
    }
);