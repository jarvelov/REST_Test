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
                url:'users/add_user',
                hide:true,
                inputs:{
                    name:{
                        type:"text",
                        slug:"name",
                        label:"Name"
                    },
                    username:{
                        pattern:"",
                        slug:"username",
                        type:"text",
                        label:"Username"
                    },
                    password:{
                        pattern:"",
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
                    },
                    requiredInputs:function() {
                        return Object.keys($scope.Forms.AddUser.inputs).length;
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
                url:'users/get_user',
                hide:true,
                inputs:{
                    username:{
                        pattern:"",
                        slug:"username",
                        type:"text",
                        label:"Username"
                    }
                },
                functions:{
                    isHidden:function() {
                        return $scope.Forms.GetUser.hide;
                    },
                    requiredInputs:function() {
                        return Object.keys($scope.Forms.GetUser.inputs).length;
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
                url:'users/get_all_users',
                hide:true,
                inputs:{},
                functions:{
                    isHidden:function() {
                        return $scope.Forms.GetAllUsers.hide;
                    },
                    requiredInputs:function() {
                        return Object.keys($scope.Forms.GetAllUsers.inputs).length;
                    }
                }
            }
        };

        $scope.formAddUser = function() {
            $scope.reset();

            $scope.Forms.AddUser.hide = !$scope.Forms.AddUser.hide;
            $scope.postURL = $scope.Forms.AddUser.url;
            $scope.requiredInputs = $scope.Forms.AddUser.functions.requiredInputs();
        }

        $scope.formGetUser = function() {
            $scope.reset();

            $scope.Forms.GetUser.hide = !$scope.Forms.GetUser.hide;
            $scope.postURL = $scope.Forms.GetUser.url;
            $scope.requiredInputs = $scope.Forms.GetUser.functions.requiredInputs();
        }

        $scope.getAllUsers = function() {
            $scope.reset();

            $scope.Forms.GetAllUsers.hide = !$scope.Forms.GetAllUsers.hide;
            $scope.postURL = $scope.Forms.GetAllUsers.url;
            $scope.requiredInputs = $scope.Forms.GetAllUsers.functions.requiredInputs();
        }

        $scope.reset = function() {
            angular.forEach($scope.Forms, function(form){
                form.hide = true; //Hide all Forms again to make sure they don't overlap each other
            });

            $scope.hideInfo = true;
            $scope.hideProgress = true;
            $scope.hideResult = true;

            $scope.result = false;
            $scope.progressPercentage = 0;

            $scope.inputs = {};
            $scope.postURL = $scope.Forms.url;
        }

        $scope.sendPost = function() {
            $scope.hideProgress = false;
            $scope.progressPercentage = 30;

            if( Object.keys($scope.inputs).length < $scope.requiredInputs ) {
                $scope.result = {
                    'data':['Not enough data'],
                    'alert':'danger',
                    'show':true,
                    'message':'Please fill out all required fields.'
                }

                $scope.hideProgress = true;

                return;
            }

            var data = {};
            angular.forEach( $scope.inputs, function(value, parameter) {
                data[parameter] = value;
            });

            $http({
              method  : 'POST',
              url     : $scope.postURL,
              data    : data
             })
             .success(function(data) {
                 console.log(data);
                 $scope.progressPercentage = 60;
                 $scope.result = {
                    'data':[],
                 }

                 if(data.hasOwnProperty('result')) {
                     if( ! ( data.result.hasOwnProperty('error') ) ) {
                         for(var key in data['result']) {
                             $scope.result['data'].push( data['result'][key] );
                         }

                         if ( $scope.result.data.length > 0 ) {
                             $scope.result.alert = 'success';
                             $scope.result.message = 'Query successfull!';
                             $scope.result.status = true;
                         } else {
                             $scope.result.alert = 'warning';
                             $scope.result.message = 'Query was successfull but did not return any data.';
                         }
                     }  else {
                         $scope.result.alert = 'danger';
                         $scope.result.message = 'Server returned an error: ' + data.result.error;
                     }
                 }
             })
             .error(function(data) {
                 console.log(data);
                 $scope.result = {
                     'data':['Server returned an error!'],
                     'alert':'danger'
                 }
              })
              .finally(function(data) {
                  console.log(data);
                  $scope.progressPercentage = 100;
                  $scope.result.show = true;
                  $timeout(function() {
                      $scope.hideProgress = true;
                      $scope.hideResult = false;
                  }, 500);
              });
        }

    }
);