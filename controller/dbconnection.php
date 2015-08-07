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
        $this->openDataBase();
    }

    private function openDataBase() {
        try {
            $this->db->openDatabase();
        } catch(Exception $e) { //Database does not seem to exist
            var_dump($e);
            throw new Exception ('General error. Please check permissions', 1); //make this prettier
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

            $result = $stmt->execute();
        } catch(Exception $e) {
            var_dump($e);
            throw new Exception("Error saving user to database!", 1);
        }

        return $result;
    }

    public function getUserFromDatabase($args) {
        extract($args);
        $query = 'SELECT username, name, password, email FROM users WHERE username = :username';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':username', $username);

            $result = $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error retrieving user from database!", 1);
        }

        return $result;
    }

    public function getAllUsersFromDatabase() {
        $query = 'SELECT username, name, password, email FROM users';

        try {
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error retrieving all users from database!", 1);
        }

        return $result;
    }
}

 ?>