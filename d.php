<?
session_start();
ini_set('mysql.connect_timeout', 3);
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
date_default_timezone_set('Europe/Istanbul');
$wallet_create_account=false;
$is_account_enabled=false;
$GLOBALS['network']="testnet";
$GLOBALS['network_id']=2;
include "db.php";
try
{
	$GLOBALS['dbh']=new PDO('mysql:host=' . $DBHost.';dbname='.$DBName, $DBUser, $DBPass);
	$GLOBALS['dbh']->query("SET NAMES 'utf8'");
	$GLOBALS['dbh']->query("SET CHARACTER SET utf8");
	$GLOBALS['dbh']->query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
	$GLOBALS['dbh']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$GLOBALS['dbh']->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
	$sql="set session sql_mode='NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO'";
	$q=$GLOBALS['dbh']->prepare($sql);
	$q->execute();
}
catch(PDOException $e)
{
	echo "DB Bağlantı Hatası: " . $e->getMessage();
}
function navoshi_to_nav($n)
{
	return ($n/100000000);
}
function is_wallet_logged_in()
{
	session_start();
	if ($_SESSION["is_wallet"]) return true; else return false;
}
function ipfs_to_url($link)
{
	$base_url="https://ipfs.nextwallet.org/ipfs/";
	$e=explode("ipfs://",$link);
	return $base_url.$e[1];
}
function title($title)
{
	echo "<title>".$title." - Priverse</title>";
}
?>