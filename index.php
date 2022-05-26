<?php
	// INCLUDE CORE FILES
	require("config.php");
	require("core/api.php");

	// CONFIGURE SHOW PHP ERRORS (SHOULD BE FALSE IN PRODUCTION)
	if($showPhpErrors){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
 
	$api = new Api();

	// ESTABLISH MYSQL CONNECTION
	$db = new mysqli($dbServer, $dbUsername, $dbPassword, $dbDatabase);

	// CHECK MYSQL CONNECTION
	if ($db->connect_error) {
		$api->response->setResults(false,"Connection failed: " . $db->connect_error);
		$api->response->display();
	}	

	// EXECUTE API CALL
	$api->execute();

	// DISPLAY API RESULTS
	$api->response->display();

	// // CHECK IF MODULE REQUIRES AUTHENTICATION
	// if($modules[$action] != 'public'){
	// 	$user_id = $_REQUEST['user_id'];
	// 	$session = $_REQUEST['session'];

	// 	if(!isAuthenticated($user_id, $session)){
	// 		$api->response->setResults(false,"Action requires a valid session");
	// 		$api->response->display();
	// 	}

	// 	// CHECK IF MODULE REQUIRES ADMIN
	// 	if($moduless[$action] == 'admin'){
	// 		if(!isAdmin($user_id)){
	// 			$api->response->setResults(false,"Action requires admin");
	// 			$api->response->display();
	// 		}
	// 	}
	// }
?>
