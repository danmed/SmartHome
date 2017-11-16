<?PHP

/* MYSQL Configuration */
$DBServer	= 	'192.168.2.75';
$DBName     	= 	'SmartHome';
$DBUser		= 	'kodi';
$DBPassword     = 	'kodi';

$db_handle = mysqli_connect($DBServer, $DBUser, $DBPassword);
$db_found = mysqli_select_db($db_handle, $DBName);

?>