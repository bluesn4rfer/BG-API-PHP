<?php
    class Db {
        public static $connection = null;

        function Db($dbServer = null, $dbDatabase = null, $dbUsername = null, $dbPassword = null) {
            if($dbServer && $dbDatabase && $dbUsername && $dbPassword){
                self::connect($dbServer, $dbDatabase, $dbUsername, $dbPassword);
            }
        }

        public static function connect($dbServer, $dbDatabase, $dbUsername, $dbPassword){
            if(!self::isConnected()){
                self::$connection = @new mysqli($dbServer, $dbUsername, $dbPassword, $dbDatabase);
            }
        }

        public static function isConnected(){
            if(!self::$connection){
                return false;
            }

            if(self::$connection->connect_error) {
                return false;
            }

            return true;            
        }

        public static function connectError(){
            return self::$connection->connect_error;
        }

        public static function prepareError(){
            return self::$connection->error;
        }

        public static function beginTransaction(){
            self::$connection->begin_transaction();
        }

        public static function endTransaction(){
            self::$connection->commit();
        }

        public static function rollBack(){
            self::$connection->rollback();
        }

        public static function disconnect(){
            if(self::isConnected()){
                self::$connection->close();
            }
        }
    }
?>