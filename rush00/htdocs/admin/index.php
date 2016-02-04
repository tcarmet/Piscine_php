<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<meta charset="utf-8">
		<title>admin</title>
	</head>
	<body>
		<div class="login_admin">
		<?php
			if (isset($_SESSION['alert']))
			{
				echo $_SESSION['alert'];
				unset($_SESSION['alert']);
			}
		?>
		<h1>Veuillez vous connecter en tant que Administrateur</h1>
		<form action="process/admin_login.php" method="POST">
			<label for="login">Login: </label><br>
			<input type="text" name="login_admin" id="login" autofocus required>
			<br><br>
			<label for="Password">Password: </label><br>
			<input type="password" name="password_admin" id="Password" required>
			<br><br>
			<input type="submit" name="submit" value="OK">
		</form>
		</div>
	</body>
</html>