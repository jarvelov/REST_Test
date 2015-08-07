<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

Class DatabaseConnection {
    const DBPATH = 'database.db';
    private $db, $dbpath;

    function __construct() {
        $this->dbpath = dirname( dirname(__FILE__) ) . '/' . self::DBPATH;
        $this->db = new Database( $this->dbpath );
    }

    public function openDataBase() {
        try {
            $this->db->openDatabase();
        } catch(Exception $e) { //Database does not seem to exist
            throw new Exception ('Database could not be opened. Make sure you\'ve run "setup.php"!', 1);
        }
    }

    public function saveUserToDatabase($args) {
        extract($args);
        $query = 'INSERT INTO users (username, name, password, email) VALUES (:username, :name, :password, :email)';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':email', $email);

            $returned_set = $stmt->execute();
        } catch(Exception $e) {
            throw new Exception("Error saving user to database!", 1);
        }

        $results = array();
        while( $row = $returned_set->fetchArray(SQLITE3_ASSOC) ) {
            $results[] = $row;
        }

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