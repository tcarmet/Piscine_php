<?php
session_start();
require ('../../functions.php');
if ($_POST['title'] && $_POST['firstname'] && $_POST['name']
	&& $_POST['desc'] && $_POST['age'] && $_POST['price'] 
	&& $_POST['categories']
	&& $_POST['submit'])
{
	$_SESSION['title'] = $_POST['title'];
	$_SESSION['firstname'] = $_POST['firstname'];
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['desc'] = $_POST['desc'];
	$_SESSION['age'] = $_POST['age'];
	$_SESSION['price'] = $_POST['price'];
	foreach ($categories as $value)
	{
		if ($value >= 1 && $value <= 3)
			$_SESSION['pool'] = $value;
		else if ($value >= 4 && $value <= 5)
			$_SESSION['year'] = $value;
		else if ($value >= 6 && $value <= 7)
			$_SESSION['gender'] = $value;
	}
	if (!isset($_POST['1_stock']))
		$_POST['1_stock'] = -1;
	if (!isset($_POST['2_stock']))
		$_POST['2_stock'] = -1;
	if (!isset($_POST['3_stock']))
		$_POST['3_stock'] = -1;
	if (!isset($_POST['4_stock']))
		$_POST['4_stock'] = -1;
	if (add_article_sql($_POST['title'], $_POST['firstname'], $_POST['name'],
		$_POST['desc'],  $_POST['age'], $_POST['price'], $_POST['categories'], $_POST['1_stock'], $_POST['2_stock'], $_POST['3_stock'], $_POST['4_stock']))
	{
		$_SESSION['alert'] = "L'article $_POST['title'] a bien été ajouté a la bdd\n";
		header("Location: ../admin_main.php");
		die();
	}
	else
	{
		$_SESSION['alert'] = "L'article n'a pas été ajouté a la bdd\n";
		header("Location: ../add_article.php");
		die();
	}

}
else
	$_SESSION['alert'] = "Information manquantes"."\n";
?>