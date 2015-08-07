var REST = angular.module("REST", []);

REST.controller(
    "mainController",
    function($scope, $http, $timeout) {
        $scope.hideInfo = false; //Will only be shown once
        $scope.hideProgress = true; //Hide progress bar initially

        //Forms
        $scope.Forms = {
            AddUser:{ //Form to add a user
                name:"add_user",
                action:"Add User!",
                url:'/add_user/',
                hide:true,
                inputs:{
                    name:{
                        type:"text",
                        label:"Name"
                    },
                    username:{
                        pattern:"[A-Za-z0-9]{0,10}",
                        type:"text",
                        label:"Username"
                    },
                    password:{
                        pattern:"[A-Za-z0-9]",
                        type:"password",
                        label:"Password"
                    },
                    email:{
                        pattern:"[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}",
                        type:"email",
                        label:"E-mail"
                    }
                },
                functions:{
                    isHidden:function() {
                        return $scope.Forms.AddUser.hide;
                    }
                }
            },
            GetUser:{ //Form to get a user by username
                name:"get_user",
                action:"Get User!",
                url:'/get_user/',
                hide:true,
                inputs:{
                    username:{
                        pattern:"[A-Za-z0-9]{0,10}",
                        type:"text",
                        label:"Username"
                    }
                },
                functions:{
                    isHidden:function() {
                        return $scope.Forms.GetUser.hide;
                    }
                }
            },
            GetAllUsers:{ //Form to get all users
                name:"get_all_users",
                action:"Get All Users!",
                url:'/get_all_users/',
                hide:true,
                functions:{
                    isHidden:function() {
                        return $scope.Forms.GetAllUsers.hide;
                    }
                }
            }
        };

        $scope.formAddUser = function() {
            $scope.reset();
            $scope.Forms.AddUser.hide = !$scope.Forms.AddUser.hide;
        }

        $scope.formGetUser = function() {
            $scope.reset();
            $scope.Forms.GetUser.hide = !$scope.Forms.GetUser.hide;
        }

        $scope.getAllUsers = function() {
            $scope.reset();
            $scope.Forms.GetAllUsers.hide = !$scope.Forms.GetAllUsers.hide;
        }

        $scope.reset = function() {
            angular.forEach($scope.Forms,function(form){
                form.hide = true; //Hide all Forms again to make sure they don't overlap each other
            });

            $scope.hideInfo = true;
            $scope.hideProgress = true;
            $scope.hideResult = true;

            $scope.result = false;
            $scope.progressPercentage = 0;
        }

        $scope.sendPost = function() {
            $scope.hideProgress = false;
            $scope.progressPercentage = 30;

            $http({
              method  : 'POST',
              url     : 'users/get_user/JohnS'
             })
              .success(function(data) {
                  $scope.progressPercentage = 60;
                  $scope.result = $.parseJSON( data['result'] );
              })
              .finally(function(data) {
                  $scope.progressPercentage = 100;
                  $timeout(function() {
                      $scope.hideProgress = true;
                      $scope.hideResult = false;
                  }, 500);
              });
        }

    }
);