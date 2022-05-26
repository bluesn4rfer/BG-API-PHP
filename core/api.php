<?php
    require("core/apiRequest.php");
    require("core/apiResponse.php");

    class Api {       
        public $request = null;
        public $response = null;

        function Api(){
            // SETUP REQUEST / RESPONSE
            $this->request = new ApiRequest();
            $this->response = new ApiResponse();
        }

        function execute(){
            // CHECK IF ACTION IS VALID
            if(!$this->request->isValidAction()){
                $this->response->setResults(false,"Invalid or no action specified");
                $this->response->display();
            }
            
            // RUN API ACTION
            $this->request->execute();
        }
    }
?>
