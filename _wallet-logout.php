<?
	header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');
	include "d.php";
	session_start() ;
	session_destroy();
	$arr["success"]=true;
	$arr["message"]="Wallet logged out";
	echo json_encode($arr);
	exit();
?>