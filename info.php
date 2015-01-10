<?php
ini_set('display_errors', 1);
include 'DBConnection.php';
include 'entities/MasterConfig.php';

$action = $_GET['action'];
if($action=="MY_IP") {
	echo $_SERVER['REMOTE_ADDR'];
}
else if($action == "GET") {
	/*header('Content-Type: application/json');*/
	$dbConnection = DBConnection::getInstance();
	$result = $dbConnection->query("select * from a7054067_apps.APP_CONFIG where CONFIG_TYPE='CHESS' AND CODE='SERVER_IP' or CODE='SERVER_PORT'");
	if (!$result) {
	    echo "DB Error, could not query the database\n";
	    echo 'MySQL Error: ' . mysql_error();
	    exit;
	}
	
	while ($row = $result->fetch_assoc()) {
	    $masterConfiog = new MasterConfig($row);
	    //echo $masterConfiog->__toString()."<BR/>";
	    echo $masterConfiog->getDesc().":";
	}
}
else if($action == "SET") {
	echo "set ip to ".$_GET['ip']."port to ".$_GET['port'];
	if(isset($_GET['ip']) && isset($_GET['port'])) {
		if(!empty($_GET['ip']) && !empty($_GET['port'])) {
			$dbConnection = DBConnection::getInstance();
			$dbConnection->query("UPDATE a7054067_apps.APP_CONFIG set DESCRIPTION='".$_GET['ip']."' where CONFIG_TYPE='CHESS' AND CODE='SERVER_IP'");
			$dbConnection->query("UPDATE a7054067_apps.APP_CONFIG set DESCRIPTION='".$_GET['port']."' where CONFIG_TYPE='CHESS' AND CODE='SERVER_PORT'");
		}
	}
}
else {
	echo "no action";
	echo 'Current PHP version: ' . phpversion();
}
exit;
?>