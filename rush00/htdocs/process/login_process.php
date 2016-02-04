<?php
session_start();
include("../functions.php");
if ($_POST["mail"])
{
	if (preg_match("/.+\@.+\..+/", $_POST["lname"]))
	{
		$_SESSION["alert"] = "Wrong mail";
		header("Location: ../index.php");
		die();
	}
	$_SESSION["mail"] = $_POST["mail"];
	if (preg_match("/.*[\.\\/\"\'\!\?\>\<\=\*\$\%\|\&\(\)\]\[\}\{\~\`\_\*\#\+\=].*/", $_POST["pass"]))
	{
		$_SESSION["alert"] = "Wrong pass";
		header("Location: ../index.php");
		die();
	}
	if (strlen($_POST["pass"]) < 5)
	{
		$_SESSION["alert"] = "Passwd len";
		header("Location: ../index.php");
		die();
	}
	if (login_sql($_POST["mail"], my_crypt($_POST["pass"], $_POST["mail"])))
	{
		unset($_SESSION["mail"]);
		header("Location: ../index.php");
		die();
	}
	unset($_SESSION["mail"]);
	$_SESSION["alert"] = "SQL error";
	header("Location: ../index.php");
	die();
}
$_SESSION["alert"] = "No mail";
header("Location: ../index.php");
die();
?>
