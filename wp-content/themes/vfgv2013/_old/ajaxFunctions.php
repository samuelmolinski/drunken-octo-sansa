<?php
//require_once("functions.php");
/*
 * Functions called during AJAX calls
 * 
 */
/*===========================================================
 * =|= 
 *==========================================================*/

function dataSanitation($data) {	
	if (is_string($data)) {
		$data = mysql_real_escape_string($data);
	} elseif (is_array($data)) {
		//recursive call for arrays
		foreach ($data as $entry) {
			$entry = dataSanitation($entry);
		}
	}
	return $data;
}

function close($return, $error, $msg) {
	$return['error'] = $error;
	$return['msg'] = $msg;

	// finally print the output.	
	echo json_encode($return);
	exit;
}

function debug($data, $return) {
	foreach ($data as $item) {
		$key = key($data);
		if (($item != NULL) && ($key != NULL)) {
			$return[$key] = $item;
		}
		next($data);
	}
	return $return;
}
