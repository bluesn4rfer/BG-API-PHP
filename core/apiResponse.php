<?php
	class ApiResponse {
		public $success = false;
		public $message = "unknown error";

		function setResults($result, $msg = "unknown error"){
			$this->success = $result;
			$this->message = $msg;
		}

		function display(){
			echo json_encode($this);
		}
	}
?>
