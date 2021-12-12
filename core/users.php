<?php
	function isAuthenticated($user_id, $session){
		global $mysql_connection;

		if(!$user_id || !$session){
			return false;
		}

		$sql = "SELECT session FROM sessions WHERE user_id='$user_id' and session='$session'";
                $result = $mysql_connection->query($sql);
                if ($result->num_rows > 0) {
			$sql_update_session = "UPDATE sessions SET last_update=NOW() WHERE user_id='$user_id' AND session='$session'";
			$mysql_connection->query($sql_update_session);
			return true;
		}
		return false;
	}
?>
