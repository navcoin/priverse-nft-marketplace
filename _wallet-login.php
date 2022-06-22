<?
	header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');
	include "d.php";
	if ($_POST)
	{
		$_SESSION["uid"]=$_POST["wallet_address"];
		$_SESSION["is_wallet"]=true;
		$arr["success"]=true;
		$arr["message"]="Logged in with wallet";
	}
	echo json_encode($arr);
	exit();
?>