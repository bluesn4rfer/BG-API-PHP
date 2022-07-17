<?php

require(__DIR__ . '/vendor/autoload.php');

db()->connect('localhost', 'api_db', 'api_db', '2iJL7OiAP5n398nj');

app()->get('/', function () {
	response()->page('./welcome.html');
});

app()->get('/words', function(){
	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Read words',
		'data' => $words
	]);
});

app()->post('/words', function(){	
	// Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	if($data === NULL){
		response()->json([
			'success' => false,
			'message' => 'Expecting array of strings'
		]);
	}

	foreach($data as $word){
		if(gettype($word) == "string"){
			db()->insert('words')->params([
				"word" => $word
			])->execute();
		}
	}

	//db()->insert('words')->params($data)->execute();
	//$data['id'] = $db->lastInsertId();

	$words = db()->select('words')->all();

	response()->json([
		'success' => true,
		'message' => 'Created words',
		'data' => $words
	]);
});

// app()->put('/words/{id}', function($id){
// 	$data = request()->get(['word']);
// 	$data['id'] = $id;

// 	response()->json([
// 		'success' => true,
// 		'message' => 'Word updated',
// 		'data' => $data
// 	]);
// });

app()->put('/words', function(){
	// Get raw body & convert to json
	$json = file_get_contents('php://input');
	$data = json_decode($json);
	if($data === NULL){
		response()->json([
			'success' => false,
			'message' => 'Expecting string or array of strings'
		]);
	}

	response()->json([
		'success' => true,
		'message' => 'Updated words',
		'data' => $data
	]);
});

// app()->delete('/words/{id}', function($id){
// 	response()->json([
// 		'success' => true,
// 		'message' => 'Word deleted',
// 		'data' => $id
// 	]);
// });

app()->delete('/words', function($id){
	response()->json([
		'success' => true,
		'message' => 'Deleted words',
		'data' => $id
	]);
});

app()->run();

