<?php
        class ApiResponse {
                public $success = false;
                public $message = "unknown error";

                function setResults($result, $msg = "unknown error"){
                        $this->success = $result;
                        $this->message = $msg;
                }

                function display(){
			// SHOW JSON RESPONSE
                        echo json_encode($this);

			// CLOSE MYSQL CONNECTION
			global $mysql_connection;
			if($mysql_connection){
				$mysql_connection->close();
			}

			// END PROGRAM
			exit(0);
                }
        }
?>
