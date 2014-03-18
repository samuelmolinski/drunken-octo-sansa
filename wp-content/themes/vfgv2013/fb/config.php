<?php

//Database Settings
define("DB_HOST", "localhost");
define("DB_NAME", "vfg2013-2");

//local
//define("DB_USER", "admin");
//define("DB_PASSWORD", "1234");

//server
define("DB_USER", "root");
define("DB_PASSWORD", "123!!@qwe");

//Debug Options
define("DEBUG", FALSE);

if (DEBUG) {
	//Error Display
	error_reporting(E_ALL);
	//PDO Options 
	define("PDO_DEBUG", TRUE);

} else {
	//PDO Options 	
	define("PDO_DEBUG", FALSE);
	error_reporting(E_ALL & ~E_NOTICE);
}

?>