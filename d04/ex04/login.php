<?php
include("auth.php");
if ($_GET['login'] && $_GET['passwd'])
{
	$login = $_GET['login'];
	$passwd = $_GET['passwd'];
	if (!file_exists("../private/passwd"))
	{
		echo "ERROR\n";
		exit ;
	}
	else
	{
		$chain = file_get_contents("../private/passwd");
		if (auth($login, $passwd))
		{
			session_start();
			$_SESSION["loggued_on_user"] = $login;
			echo "OK\n";
		}
		else
		{
			session_start();
			$_SESSION["loggued_on_user"] = "";
			echo "ERROR\n";
		}
	}
}
else
	echo "ERROR"."\n";
?>