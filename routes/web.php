<?php

$app->get('/api/factorio/mod/{mod}', function ($mod){
	$data = redis()->get($mod);

	if(!$data){
		try {
			$data = file_get_contents("https://mods.factorio.com/api/mods/".$mod);
		}catch(Exception $e){
			return response(null, 404);
		}

		redis()->setex($mod, 600, $data);
	}

	return response($data)->header('Content-Type', "application/json");
});