<?php
	function isAdmin($user_id){
		global $mysql_connection;

		if(!$user_id){
			return false;
		}

		$sql = "SELECT isAdmin FROM users WHERE id='$user_id' AND isAdmin='Y'";
                $result = $mysql_connection->query($sql);
                if ($result->num_rows > 0) {
			return true;
		}
		return false;
	}
?>
