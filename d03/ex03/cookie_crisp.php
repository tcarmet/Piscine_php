<?php
	if ($_GET["action"] == "set" && $_GET["name"] && $_GET["value"])
		setcookie($_GET["name"], $_GET["value"]);
	else if ($_GET["action"] == "get" && $_GET["name"])
	{
		if ($cookie = $_COOKIE[$_GET["name"]])
			echo $cookie."\n";
	}
	else if ($_GET["action"] == "del" && $_GET["name"])
		setcookie($_GET["name"], $_GET["value"], 0);
?>