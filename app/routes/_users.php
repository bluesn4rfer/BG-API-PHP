<?php

app()->post('/token', function () {
    //echo view('index');
    // Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);

	// Username & Password not sent
	if(!$data || !$data->username || !$data->password){
		response()->json([ 
			'success' => false,
			'message' => 'Missing username or password',
			'data' => null 
		], 400);		
	}

	// Authenticate
	$user = auth()->login([
		'username' => $data->username,
		'password' => $data->password
	]);

	// Authentication error
	if (!$user) {
		response()->json([ 
			'success' => false,
			'message' => 'Authentication error',
			'data' => auth()->errors() 
		], 400);
	}

	// Response
	response()->json([
		'success' => true,
		'message' => 'Authentication successful',
		'data' => $user
	]);
});
