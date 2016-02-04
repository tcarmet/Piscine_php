<?php
	session_start();
	require('../../functions.php');
	
	if ($_GET['id'])
	{
		if (delete_customers_sql($_GET['id']))
		{
			$_SESSION = "L'utilisateur a été effacé.\n";
			header("Location: ../admin_main.php");
			die();
		}
		else
		{
			$_SESSION = "L'utilisateur n'a pas été effacé.\n";
			header("Location: ../supp_utilisateur.php");
			die();
		}
	}
	else
	{
		$_SESSION = "Formulaire non valide\n";
		header("Location: ../supp_user.php");
		die();
	}
?>