<?php
	session_start();
	require('../../functions.php');
	if (update_article_sql($_POST['id'], $_POST['title'], $_POST['firstname'], $_POST['name'],
		$_POST['desc'], $_POST['age'], $_POST['price']))
	{
		$_SESSION['alert'] = "article modifié\n";
		header("Location: ../admin_main.php");
		die();
	}
	else 
	{
		$_SESSION['alert'] = "article non modifié\n";
		header("Location: ../admin_main.php");
		die();
	}

?>