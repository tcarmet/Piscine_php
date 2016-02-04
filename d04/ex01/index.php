<?php
	session_start();
	if ($_GET["login"] && $_GET["passwd"] && $_GET["submit"] == OK)
	{
		 $_SESSION["value"] = $_GET["login"];
		 $_SESSION["passwd"] = $_GET["passwd"];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>session
		</title>
	</head>
	<body>
	<form action="index.php" method="GET">
		<label for="Identifiant">Identifiant: </label><br>
		<input type="text" name="login" id="Identifiant" value="<?php echo $_SESSION["value"];?>" autofocus>
		<br><br>
		<label for="Mdp">Mot de passe: </label><br>
		<input type="password" name="passwd" id="Mdp" value="<?php echo $_SESSION["passwd"];?>">
		<input type="submit" name="submit" value="OK">
		<br>
	</form>
	</body>
</html>
