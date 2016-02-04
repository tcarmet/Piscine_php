<?php
	session_start();
	unset($_SESSION['id_admin'], $_SESSION['login_admin'], $_SESSION['email_admin'], $_SESSION['rank_admin']);
	header("Location: index.php");
	die();
?>