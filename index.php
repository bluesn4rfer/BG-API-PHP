<?php
	// INCLUDE CORE FILES
	require("config.php");
	require("core/strings.php");
	require("core/users.php");
	require("core/admin.php");
	require("core/apiresponse.php");
	require("core/modules.php");

	// LOAD MODULES
	$modules = loadModules();

	// CREATE JSON API RESPONSE OBJECT
	$apiResponse = new ApiResponse();

	// GET ACTION FROM HTTPS REQUEST
	$action = strtolower($_REQUEST['action']);

	// CHECK IF ACTION IS VALID
        if((!$action) || (!$modules[$action])){
                if (!$action){
                        $apiResponse->setResults(false,"No action specified");
			$apiResponse->display();
                }
                else if(!$modules[$action]){
                        $apiResponse->setResults(false,"Invalid action specified");
			$apiResponse->display();
                }
        }

        // ESTABLISH MYSQL CONNECTION
        $mysql_connection = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

        // CHECK MYSQL CONNECTION
        if ($mysql_connection->connect_error) {
                $apiResponse->setResults(false,"Connection failed: " . $mysql_connection->connect_error);
		$apiResponse->display();
        }

	// CHECK IF MODULE REQUIRES AUTHENTICATION
	if($modules[$action] != 'public'){
		$user_id = $_REQUEST['user_id'];
		$session = $_REQUEST['session'];

		if(!isAuthenticated($user_id, $session)){
			$apiResponse->setResults(false,"Action requires a valid session");
			$apiResponse->display();
		}

		// CHECK IF MODULE REQUIRES ADMIN
		if($moduless[$action] == 'admin'){
			if(!isAdmin($user_id)){
				$apiResponse->setResults(false,"Action requires admin");
				$apiResponse->display();
			}
		}
	}

	// RUN API ACTION
	if(function_exists($action)){
		$action();
	}
	else{
		$apiResponse->setResults(false,"Problem with action");
		$apiResponse->display();
	}

	// DISPLAY API RESULTS
	$apiResponse->display();
?>
