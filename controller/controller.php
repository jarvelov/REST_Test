<?php

Class RestController {

    function __construct() {
        if( class_exists('Flight') ) {
            //Hook up all REST requests to functions
            Flight::route('/', function() {
                $this->init();
            });

            //Add a new user
            Flight::route('/users/add_user/@name/@username/@password/@email', function( $name, $username, $password, $email ) {
                $this->addUser( $name, $username, $password, $email );
            } );

            //Get user by username
            Flight::route('/users/get_user/@username', function( $username ) {
                $this->getUser( $username );
            });

            //Get all users
            Flight::route('/users/get_user/@username', function() {
                $this->getAllUsers();
            });
        } else {
            echo "Error: Flight framework is not initalized!";
        }
    }

    /** REST callbacks **/

    public function addUser($name, $username, $password, $email) {
        echo $name;
    }

    public function getAllUsers() {

    }

    public function getUser($username) {

    }

    /** Helper Classes **/

    //Ready for take off!
    public function start() {
        Flight::start();
    }

    public function convertToJSON($string) {
        return Flight::json($string);
    }

    /** Database Communication **/

    public function saveUser($name, $username, $password, $email) {
        echo "Saved user: $name";
    }

}

 ?>