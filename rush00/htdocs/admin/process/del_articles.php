<?php
	session_start();
	require('../../functions.php');
	
	if ($_GET['id'])
	{
		if (delete_article_sql($_GET['id']))
		{
			$_SESSION = "L'article a été effacé.\n";
			header("Location: ../admin_main.php");
			die();
		}
		else
		{
			$_SESSION = "L'article n'a pas été effacé.\n";
			header("Location: ../supp_article.php");
			die();
		}
	}
	else
	{
		$_SESSION = "Formulaire non valide\n";
		header("Location: ../supp_article.php");
		die();
	}
?>