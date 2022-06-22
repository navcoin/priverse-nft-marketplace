<?
include "d.php";
include "header.php";
if (empty($_GET["a"]))
{
	include "home.php";
}
else
{
	$filename="_" . $_GET["a"] . ".php";
	if (file_exists($filename))
	{
		if (!is_wallet_logged_in()&&($_GET["a"]=="create-collection"||$_GET["a"]=="create-nft"||$_GET["a"]=="profile"))
		{
			include "_wallet-login-required.php";
		}
		else
		{
			include $filename;
		}
	}
	else
	{
		?>
		<h1>Page not found.</h1>
		<?
	}
}
include "main.php";
include "footer.php";
?>