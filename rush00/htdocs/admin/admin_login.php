<?php
	session_start();
	require ('./functions.php');
	if isset($_POST['login_admin']) && isset($_POST['password_admin']) && isset($_POST['submit']))
	{
		$login = $_POST['login_admin'];
		$passwd = my_crypt($_POST['password_admin'], $_POST['login_admin']);
		if (connect_adm_sql($login, $passwd))
			header("Location: ./admin_main.php")
			die();
		else
			echo "Mauvais identifiants.\n";
	}
	else
		echo "Veuillez entrez un nom d'utilisateur et un mot de passe\n";
?>