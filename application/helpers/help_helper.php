<?php

function unique_code($unique = NULL){
date_default_timezone_set('Etc/GMT-7');
	$date = date_create();
	if ($unique == NULL) {
		$unique = rand(10,99);
	}

	$code = rand(100,999)."-".substr(date_timestamp_get($date), -5)."-".rand(10,99)."-".rand(10,99);

	return $code;
}
//	END of UNIQUE CODE


?>
