<?php

Class RestController {

    function __construct() {
        $this->init();
    }

    /** REST callbacks **/

    public function addUser($name, $username, $password, $email) {
        $result = $this->addDatabaseUser($name, $username, $password, $email);

        var_dump($result);

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = array('error' => 'Unable to save user!');
        }

        $this->output($message);
    }

    public function getAllUsers() {
        $result = $this->getAllDatabaseUsers();

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = array('error' => 'Unable to retrieve a list of all users!');
        }

        $this->output($message);
    }

    public function getUser($username) {
        $result = $this->getDatabaseUser($username);

        if( $result['success'] === true ) {
            $message = $result['message'];
        } else {
            $message = array('error' => 'Unable to retrieve specified user!');
        }

        $this->output($message);
    }

    /** Helper Classes **/

    //Check if environment is functional
    public function testEnvironment() {
        $errors = array();
        if ( !class_exists('SQLite3') )
            $errors[] = 'SQLite3 is not installed. Please refer to your distribution for install instructions! (Ubuntu: apt-get install sqlite php5-sqlite)';

        if( class_exists('Flight') ) {
            $this->addRoutes();
        } else {
            $errors[] = "Error: Flight framework is not initalized!";
        }

        $this->errors = $errors;
    }

    //Check result and return an associative array
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

    //Echo string in JSON
    private function output($string) {
        $json =  json_encode( array( 'result' => $string ), true );
        echo $json;
    }

    //Init app
    public function init() {
        $this->testEnvironment();

        try {
            $this->connection = new DatabaseConnection();
        } catch(Exception $e) {
            $this->errors = $e->getMessage();
        }

        $this->start();
    }

    /* Flight Framework functions */

    public function addRoutes() {
        //Hook up all REST requests to functions
        Flight::route('/', function() {
            new Model($this->errors);
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
    }

    //Ready for take off!
    public function start() {
        Flight::start();
    }

    /** Database Communication **/

    private function addDatabaseUser($name, $username, $password, $email) {
        try {
            $result = $this->connection->saveUserToDatabase( array(
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'email' => $email
            ) );
        } catch(Exception $e) {
            //TODO handle error
            $result = false;
        }

        var_dump($result);
        die();

        return $this->handleDatabaseResult($result);
    }

    private function getDatabaseUser($username) {
        try {
            $result = $this->connection->getUserFromDatabase( array(
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
            $result = $this->connection->getAllUsersFromDatabase();
        } catch(Exception $e) {
            //TODO handle error
            $result = false;
        }

        return $this->handleDatabaseResult($result);
    }

}

 ?>