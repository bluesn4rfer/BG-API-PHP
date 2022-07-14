<?php
    require_once("apiRequest.php");
    require_once("apiResponse.php");

    class Api {       
        public static $request = null;
        public static $response = null;

        function Api(){
            // SETUP REQUEST / RESPONSE
            self::$request = new ApiRequest();
            self::$response = new ApiResponse();
        }

        public static function execute(){
            // CHECK IF ACTION IS VALID
            if(!self::isValidAction()){
                self::$response->setResults(false,"Invalid or no action specified");
                return;
            }
            
            // RUN API ACTION
            require("modules/".self::$request->module."/".self::$request->action.".php");
        }

        public static function isValidAction(){
            if(file_exists("modules/".self::$request->module."/".self::$request->action.".php")){
                return true;
            }
            return false;
        } 
    }
?>
