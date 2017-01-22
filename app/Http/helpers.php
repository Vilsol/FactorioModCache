<?php

$redis_cached = null;

/**
 * @param int $db
 *
 * @return Redis
 */
function redis(int $db = 0): Redis {
	global $redis_cached;

	if(is_null($redis_cached)){
		$redis_cached = new Redis();
		$redis_cached->pconnect(env("REDIS_HOST"), env("REDIS_PORT"));

		if(!is_null(env("REDIS_PASSWORD"))){
			$redis_cached->auth(env("REDIS_PASSWORD"));
		}
	}

	$redis_cached->select($db);

	return $redis_cached;
}