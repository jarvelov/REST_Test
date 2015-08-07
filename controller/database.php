<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(class_exists('SQLite3')) {
    Class Database extends SQLite3 {
        protected $db, $dbpath;
        function __construct($database) {
            $this->dbpath = $database;
        }

        public function openDatabase() {
            try {
                $this->db = $this->open( $this->dbpath );
            } catch(Exception $e) {
                var_dump($e);
                throw new Exception("Error Opening Database. Does it exist?", 1);
            }
        }

        public function createDatabase() {
            $this->db = new SQLite3( $this->dbpath );
            $this->createTable();
            $this->insertSampleData();
        }

        private function createTable() {
            $table_query = 'CREATE TABLE IF NOT EXISTS users (
                username VARCHAR(255),
                name VARCHAR(255),
                password VARCHAR(255),
                email VARCHAR(255)
            );';

            $table_stmt = $this->db->prepare($table_query);
            $table_stmt->execute();
        }

        private function insertSampleData() {
            $rows = array(
                '"JohnS","John Simonson","SuperS3cure","john.simonson@example.com"',
                '"AliceC","Alice Cooper","SpookyFella97","alice.cooper@example.com"',
                '"StevenT","Steven Tyler","RockOn4Lyfe","steven.tyler@example.com"'
            );

            $results = array();
            foreach($rows as $row) {
                $insert_query = 'INSERT INTO users (username, name, password, email) VALUES (' . $row . ' );';
                $insert_stmt = $this->db->prepare($insert_query);
                $results[] = $insert_stmt->execute();
            }
        }
    }
}
?>