<?php

if(class_exists('SQLite3')) {
    Class Database extends SQLite3 {
        protected $db, $dbpath;
        function __construct($database) {
            $this->dbpath = $database;
        }

        public function open() {
            try {
                $this->db = $this->open( $this->database );
            } catch(Exception $e) {
                throw new Exception("Error Opening Database. Does it exist?", 1);
            }
        }

        public function create() {
            $this->db = new SQLite3( $this->dbpath );
            $this->fill();
        }

        private function fill() {
            $table_query = 'CREATE TABLE IF NOT EXIST users (
                id mediumint(9) AUTO_INCREMENT,
                username VARCHAR(255),
                name VARCHAR(255),
                password VARCHAR(255),
                email VARCHAR(255),
                UNIQUE KEY id (id)
            );';

            $table_stmt = $this->db->prepare($table_query);
            $table_stmt->execute();

            $data_query = 'INSERT INTO users (id, username, name, password, email) VALUES (
                    1,"JohnS","John Simonson","SuperS3cure","john.simonson@example.com",
                    2,"AliceC","Alice Cooper","SpookyFella97","alice.cooper@example.com",
                    1,"StevenT","Steven Tyler","RockOn4Lyfe","steven.tyler@example.com",
                )';

            $data_stmt = $this->db->prepare($data_query);
            $data_stmt->execute();
        }
    }
}
?>