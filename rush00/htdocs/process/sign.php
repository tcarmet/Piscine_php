<?php
session_start();
include("../functions.php");
if ($_POST["gender"])
{
	if ($_POST["gender"] !== "Mr" && $_POST["gender"] !== "Mme" && $_POST["gender"] !== "Trans")
	{
		$_SESSION["alert"] = "Wrong gender";
		header("Location: ../index.php?pg=sign_in");
		die();
	}
	$_SESSION["gender"] = $_POST["gender"];
	if ($_POST["fname"])
	{
		if (!ctype_alpha($_POST["fname"]))
		{
			$_SESSION["alert"] = "Wrong fname";
			header("Location: ../index.php?pg=sign_in");
			die();
		}
		$_SESSION["fname"] = $_POST["fname"];
		if ($_POST["lname"])
		{
			if (!ctype_alpha($_POST["lname"]))
			{
				$_SESSION["alert"] = "Wrong lname";
				header("Location: ../index.php?pg=sign_in");
				die();
			}
			$_SESSION["lname"] = $_POST["lname"];
			if ($_POST["mail"])
			{
				if (!preg_match("/.+\@.+\..+/", $_POST["mail"]))
				{
					$_SESSION["alert"] = "Wrong mail";
					header("Location: ../index.php?pg=sign_in");
					die();
				}
				$_SESSION["mail"] = $_POST["mail"];
				if ($_POST["pass"] === $_POST["cpass"])
				{
					if (preg_match("/.*[\.\\/\"\'\!\?\>\<\=\*\$\%\|\&\(\)\]\[\}\{\~\`\_\*\#\+\=].*/", $_POST["pass"]))
					{
						$_SESSION["alert"] = "Wrong pass";
						header("Location: ../index.php?pg=sign_in");
						die();
					}
					if (strlen($_POST["pass"]) < 5)
					{
						$_SESSION["alert"] = "Passwd len";
						header("Location: ../index.php?pg=sign_in");
						die();
					}
					if (signin_sql($_POST["gender"], $_POST["fname"], $_POST["lname"], $_POST["mail"], my_crypt($_POST["pass"], $_POST["mail"])))
					{
							unset($_SESSION["gender"], $_SESSION["mail"], $_SESSION["lname"], $_SESSION["fname"], $_SESSION['alert']);
							header("Location: ../index.php");
							die();
					}
					unset($_SESSION["gender"], $_SESSION["mail"], $_SESSION["lname"], $_SESSION["fname"]);
					$_SESSION["alert"] = "SQL error";
					header("Location: ../index.php?pg=sign_in");
					die();
				}
				$_SESSION["alert"] = "Passwd diff";
				header("Location: ../index.php?pg=sign_in");
				die();
			}
			$_SESSION["alert"] = "No mail";
			header("Location: ../index.php?pg=sign_in");
			die();
		}
		$_SESSION["alert"] = "No lname";
		header("Location: ../index.php?pg=sign_in");
		die();
	}
	$_SESSION["alert"] = "No fname";
	header("Location: ../index.php?pg=sign_in");
	die();
}
$_SESSION["alert"] = "No gender";
header("Location: ../index.php?pg=sign_in");
die();
?>
