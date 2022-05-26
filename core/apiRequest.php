<?php
    class ApiRequest {
        public $module = null;
        public $action = null;
        public $args = array();
        public $body = null;
        
        function ApiRequest(){
            if(array_key_exists('PATH_INFO', $_SERVER)){
                $this->args = explode("/",strtolower(rtrim(ltrim($_SERVER['PATH_INFO'],'/'),'/')));
                $this->module = array_shift($this->args);

                switch($_SERVER['REQUEST_METHOD']){
                    case "GET":
                        $this->action = "read";
                        break;
                    case "POST":
                        $this->action = "create";
                        break;
                    case "PUT":
                        $this->action = "update";
                        break;
                    case "DELETE":
                        $this->action = "delete";
                        break;
                }
                
            }

            $fh = fopen('php://input','r');
            $this->body = stream_get_contents($fh);
        }

        function isValidAction(){
            if(file_exists("modules/".$this->module."/".$this->action.".php")){
                return true;
            }
            return false;
        } 

        function execute(){
            require("modules/".$this->module."/".$this->action.".php");
        }
    }
?>