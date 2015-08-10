<?php

Class RestController {

    function __construct() {
        $this->testEnvironment();
        $this->init();
    }

    /** REST callbacks **/

    public function addUser($data) {
        $missing = $this->missingRequiredParameters( $data, array( 'name', 'username', 'password', 'email' ) );

        if($missing) {
            $parameters = "";
            foreach($missing as $error)
                $parameters .=  $error . ' ';
            }

            $message = array( 'error' => 'Data is missing parameter(s): ' . $parameters );
        }

        if( ! ( isset($message) ) ) {
            try {
                $result = $this->addDatabaseUser(
                    $data->name,
                    $data->username,
                    $data->password,
                    $data->email
                );

                if( $result['success'] === true ) {
                    $message = $result['message'];
                } else {
                    $message = array('error' => 'Unable to save user!');
                }
            } catch(Exception $e) {
                $message = array('error' => $e->getMessage() );
            }
        }

        $this->output($message);
    }

    public function getUser($data) {
        $missing = $this->missingRequiredParameters( $data, array('username') );

        if($missing) {
            $parameters = "";
            foreach($missing as $error)
                $parameters .=  $error . ' '
            }

            $message = array( 'error' => 'Data is missing parameter(s): ' . $parameters);
        }

        if( ( ! ( isset( $message ) ) ) {
            try {
                $result = $this->getDatabaseUser($data->username);

                if( $result['success'] === true ) {
                    $message = $result['message'];
                } else {
                    $message = array('error' => 'Unable to retrieve specified user!');
                }
            } catch(Exception $e) {
                $message = array('error' => $e->getMessage() );
            }
        }

        $this->output($message);
    }

    public function getAllUsers() {
        try {
            $result = $this->getAllDatabaseUsers();

            if( $result['success'] === true ) {
                $message = $result['message'];
            } else {
                $message = array('error' => 'Unable to retrieve a list of all users!');
            }
        } catch(Exception $e) {
            $message = array('error' => $e->getMessage() );
        }

        $this->output($message);
    }

    /** Helper Classes **/

    //Check if environment is functional
    public function testEnvironment() {
        $errors = array();
        if ( !class_exists('SQLite3') )
            $errors[] = 'SQLite3 is not installed. Please refer to your distribution for install instructions! (Ubuntu: apt-get install sqlite php5-sqlite)';

        if( !class_exists('Flight') ) {
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

    private function missingRequiredParameters($obj, $required) {
        $args = array();
        foreach ($obj as $key => $value) {
            $args[$key] = $value;
        }

        $missing = array();

        foreach ($required as $key) {
            if ( ! ( array_key_exists($key, $args) ) ) {
                $missing[] = $key);
            }
        }

        if(!$missing) {
            $missing = false;
        }

        return $missing;
    }

    //Echo string in JSON
    private function output($string) {
        $json =  json_encode( array( 'result' => $string ), true );
        echo $json;
    }

    //Init app
    public function init() {
        try {
            $this->connection = new DatabaseController();
            $this->addRoutes();
            $this->start();
        } catch(Exception $e) {
            $this->errors = $e->getMessage();
        }
    }

    /* Flight Framework functions */

    public function addRoutes() {
        //Hook up all REST requests to functions
        Flight::route('/', function() {
            Flight::render('view', array('errors' => $this->errors));
        });

        //Add a new user
        Flight::route('/users/add_user', function() {
            $raw_data = Flight::request()->data;
            $this->addUser( $raw_data );
        } );

        //Get user by username
        Flight::route('/users/get_user', function() {
            $raw_data = Flight::request()->data;
            $this->getUser( $raw_data );
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
            throw new Exception( $e->getMessage(), $e->getCode() );

        }

        return $this->handleDatabaseResult($result);
    }

    private function getDatabaseUser($username) {
        try {
            $result = $this->connection->getUserFromDatabase( array(
                'username' => $username
            ) );
        } catch(Exception $e) {
            throw new Exception( $e->getMessage(), $e->getCode() );
        }

        return $this->handleDatabaseResult($result);
    }

    private function getAllDatabaseUsers() {
        try {
            $result = $this->connection->getAllUsersFromDatabase();
        } catch(Exception $e) {
            throw new Exception( $e->getMessage(), $e->getCode() );
        }

        return $this->handleDatabaseResult($result);
    }

}

 ?>