<?php
	// INCLUDE CORE FILES
	require_once("config.php");
	require_once("core/db.php");
	require_once("core/log.php");
	require_once("core/api.php");

	// CONFIGURE SHOW PHP ERRORS (SHOULD BE FALSE IN PRODUCTION)
	if($showPhpErrors){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}

	new Db($dbServer, $dbDatabase, $dbUsername, $dbPassword);
	new Log();	
	new Api();

	// CHECK MYSQL CONNECTION
	if (!Db::isConnected()) {
		Api::$response->setResults(false,"Database connection failed: " . Db::connectError());
	}
	else{
		// LOG REQUEST
		Log::info(Api::$request->body);

		// EXECUTE API CALL
		Api::execute();

		// LOG RESPONSE
		if(Api::$request->module != "logs"){
			Log::info(json_encode(Api::$response));
		}
	}
	
	// DISPLAY API RESULTS
	Api::$response->display();

	// DISCONNECT MYSQL
	Db::disconnect();

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
