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
                operation:{
                    success:'added user',
                    danger:'add user'
                },
                url:'users/add_user/',
                hide:true,
                inputs:{
                    name:{
                        type:"text",
                        slug:"name",
                        label:"Name"
                    },
                    username:{
                        pattern:"[A-Za-z0-9]{0,10}",
                        slug:"username",
                        type:"text",
                        label:"Username"
                    },
                    password:{
                        pattern:"[A-Za-z0-9]",
                        slug:"password",
                        type:"text",
                        label:"Password"
                    },
                    email:{
                        pattern:"",
                        slug:"email",
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
                operation:{
                    success:'get user',
                    danger:'get user'
                },
                url:'users/get_user/',
                hide:true,
                inputs:{
                    username:{
                        pattern:"[A-Za-z0-9]{0,10}",
                        slug:"username",
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
                operation:{
                    success:'got all users',
                    danger:'get all users'
                },
                url:'users/get_all_users/',
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
            $scope.postURL = $scope.Forms.url;
        }

        $scope.formGetUser = function() {
            $scope.reset();
            $scope.Forms.GetUser.hide = !$scope.Forms.GetUser.hide;
            $scope.postURL = $scope.Forms.url;
        }

        $scope.getAllUsers = function() {
            $scope.reset();
            $scope.Forms.GetAllUsers.hide = !$scope.Forms.GetAllUsers.hide;
            $scope.postURL = $scope.Forms.url;
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

            $scope.inputs = {};
            $scope.postURL = $scope.Forms.url;

            $scope.action = {
                class:'danger',
                hide:true,
                message:'',
                operation:''
            }
        }

        $scope.sendPost = function() {
            $scope.hideProgress = false;
            $scope.progressPercentage = 30;

            console.log($scope.inputs, $scope.postURL);
/*
            $http({
              method  : 'POST',
              url     : 'users/get_user/JohnS'
             })
              .success(function(data) {
                  $scope.progressPercentage = 60;
                  $scope.result = data['result'];

                  $scope.action.class = 'success';
                  $scope.action.hide = false;
                  $scope.action.message:'Successfully ' + $scope.action.operation;
              })
              .failure(function(data) {
                  $scope.action.class = 'danger';
                  $scope.action.hide = false;
                  $scope.action.message:'Failed to ' + $scope.action.operation;
              })
              .finally(function(data) {
                  $scope.progressPercentage = 100;
                  $timeout(function() {
                      $scope.hideProgress = true;
                      $scope.hideResult = false;
                  }, 500);
              });
              */
        }

    }
);