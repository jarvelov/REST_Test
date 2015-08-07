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
            Flight::route('/users/get_all_users', function() {
                $this->getAllUsers();
            });
        } else {
            echo "Error: Flight framework is not initalized!";
        }
    }

    /** REST callbacks **/

    public function addUser($name, $username, $password, $email) {
        $result = $this->addDatabaseUser($name, $username, $password, $email);

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = 'Error: Unable to save user!';
        }

        $this->output($message);
    }

    public function getAllUsers() {
        $result = $this->getAllDatabaseUsers();

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = 'Error: Unable to retrieve a list of all users!';
        }

        $this->output($message);
    }

    public function getUser($username) {
        $result = $this->getDatabaseUser($username);

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = 'Error: Unable to retrieve a list of all users!';
        }

        $this->output($message);
    }

    /** Helper Classes **/

    public function init() {
        $errors = $this->testEnvironment();
        $model = new Model($errors);
    }

    //Ready for take off!
    public function start() {
        Flight::start();
    }

    //Check if environment is functional
    public function testEnvironment() {
        $errors = array();
        if ( !class_exists('SQLite3') )
            $errors[] = 'SQLite3 is not installed. Please refer to your distribution for install instructions! (Ubuntu: apt-get install sqlite php5-sqlite)';

        return $errors;
    }

    private function output($message) {
        $json =  $this->convertToJSON( $message );
        echo $json;
    }

    private function convertToJSON($string) {
        return Flight::json($string);
    }

    private function handleDatabaseResult($result) {
        if($result) {
            $return = array(
                'success' => true,
                'message' => $result
            );
        } else {
            $return = array(
                'success' => false
            );
        }

        return $return;
    }

    /** Database Communication **/

    private function addDatabaseUser($name, $username, $password, $email) {
        try {
            $dbConn = new DatabaseConnection();
            $result = $dbConn->saveUserToDatabase( array(
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'email' => $email
            ) );
        } catch(Exception $e) {
            //TODO handle error
            $result = false;
        }

        return $this->handleDatabaseResult($result);
    }

    private function getDatabaseUser($username) {
        try {
            $dbConn = new DatabaseConnection();
            $result = $dbConn->getUserFromDatabase( array(
                'username' => $username
            ) );
        } catch(Exception $e) {
            //TODO handle error
            $result = false;
        }

        return $this->handleDatabaseResult($result);
    }

    private function getAllDatabaseUsers() {
        try {
            $dbConn = new DatabaseConnection();
            $result = $dbConn->getAllUsersFromDatabase();
        } catch(Exception $e) {
            //TODO handle error
            $result = false;
        }

        return $this->handleDatabaseResult($result);
    }

}

 ?>