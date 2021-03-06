<?php

require(__DIR__ . '/vendor/autoload.php');

db()->connect('localhost', 'api_db', 'api_db', '2iJL7OiAP5n398nj');

app()->get('/', function () {
	response()->page('./welcome.html');
});

app()->post('/login', function(){
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

app()->post('/register', function(){
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

	// Register user
	$user = auth()->register([
		'username' => $data->username,
		'password' => $data->password,
	],['username']);

	// Error registering
	if (!$user) {
		response()->json([ 
			'success' => false,
			'message' => 'Register error',
			'data' => auth()->errors() 
		], 400);
	}

	// Response
	response()->json($user);
});

app()->post('/words', function(){	
	// Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	if(gettype($data) !== "array"){
		response()->json([
			'success' => false,
			'message' => 'Expecting array of strings',
			'data' => null
		], 400);
	}

	// Add to database
	foreach($data as $word){
		if(gettype($word) === "string"){
			db()->insert('words')->params([
				"word" => $word
			])->execute();
		}
	}

	// Response
	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Created words',
		'data' => $words
	]);
});

app()->get('/words', function(){
	// Response
	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Read words',
		'data' => $words
	]);
});

app()->put('/words', function(){
	// Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	if(gettype($data) !== "array"){
		response()->json([
			'success' => false,
			'message' => 'Expecting array of objects',
			'data' => null
		], 400);
	}

	// Update database
	foreach($data as $obj){
		if(gettype($obj) === "object"){
			db()->update('words')->params([
				"word" => $obj->word
			])->where([
				"id" => $obj->id
			])->execute();
		}
	}

	// Response
	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Updated words',
		'data' => $words
	]);
});

app()->delete('/words', function(){
	// Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	if(gettype($data) !== "array"){
		response()->json([
			'success' => false,
			'message' => 'Expecting array of ids',
			'data' => null
		], 400);
	}

	// Delete from database
	foreach($data as $id){
		if(gettype($id) === "integer"){
			db()->delete('words')->where([
				"id" => $id
			])->execute();
		}
	}

	// Response
	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Deleted words',
		'data' => $words
	]);
});

app()->run();

