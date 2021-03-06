<?php

Class DatabaseController {
    const DBPATH = 'database.db';
    private $db, $dbpath;

    function __construct() {
        $this->dbpath = dirname( dirname(__FILE__) ) . '/' . self::DBPATH;
        $this->db = new Database( $this->dbpath );
        $this->openDataBase();
    }

    private function openDataBase() {
        try {
            if( !file_exists( $this->dbpath ) ) {
                $this->db->createDatabase(); //This is probably the first time this is running, create the database with sample data
            }
            $this->db->openDatabase();
        } catch(Exception $e) { //Database does not seem to be able to be opened
            throw new Exception ('Database could not be opened. Make sure you\'ve run "setup.php"!', 1);
        }
    }

    public function saveUserToDatabase($args) {
        extract($args);
        //Verify that the username isn't already taken
        try {
            $user_exists = $this->getUserFromDatabase( array('username' => $username) );
        } catch(Exception $e) {
            throw new Exception("Error verifying username availability before saving user to database!", 1);
        }

        if(isset($user_exists) AND !empty($user_exists)) {
            throw new Exception("User with that username already exists", 1);
        }

        $query = 'INSERT INTO users (username, name, password, email) VALUES (:username, :name, :password, :email)';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':email', $email);

            $stmt->execute();
        } catch(Exception $e) {
            throw new Exception("Error saving user to database!", 1);
        }

        //We've got this far, return the user we just saved from the database
        $results = $this->getUserFromDatabase( array('username' => $username) );

        return $results;
    }

    public function getUserFromDatabase($args) {
        extract($args);
        $query = 'SELECT username, name, password, email FROM users WHERE username = :username';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);

            $returned_set = $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error retrieving user from database!", 1);
        }

        $results = array();
        while( $row = $returned_set->fetchArray(SQLITE3_ASSOC) ) {
            $results[] = $row;
        }

        return $results;
    }

    public function getAllUsersFromDatabase() {
        $query = 'SELECT username, name, password, email FROM users';

        try {
            $stmt = $this->db->prepare($query);
            $returned_set = $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error retrieving all users from database!", 1);
        }

        $results = array();
        while( $row = $returned_set->fetchArray(SQLITE3_ASSOC) ) {
            $results[] = $row;
        }

        return $results;
    }
}

 ?>