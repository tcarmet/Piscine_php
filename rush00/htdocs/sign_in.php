<?php
unset($_SESSION['id_customer'], $_SESSION['civilite_customer'], $_SESSION['firstname_customer'], $_SESSION['name_customer'], $_SESSION['email_customer']);
include("includes/top.php");
?>
	<?php
		if ($_SESSION['alert'])
		{
			echo $_SESSION['alert'];
			unset($_SESSION['alert']);
		}
	?>
	<div class="content" style="text-align: center;">
		<form action="process/sign.php" method="POST">
		<label for="Mr">Mr.</label><input type="radio" id="Mr" name="gender" value="Mr" checked="checked"/>
		<label for="Mme">Mme.</label><input type="radio" id="Mme" name="gender" value="Mme" />
		<label for="Trans">Trans.</label><input type="radio" id="Trans" name="gender" value="Trans" /><br />
		<label for="fname">Prénom</label><br />
		<input type="text" id="fname" name="fname" value="<?php if ($_SESSION["fname"]) echo $_SESSION["fname"];?>" required/><br />
		<label for="lname">Nom</label><br />
		<input type="text" id="lname" name="lname" value="<?php if ($_SESSION["lname"]) echo $_SESSION["lname"];?>" required/><br />
		<label for="usr">E-Mail</label><br />
		<input type="email" id="usr" name="mail" value="<?php if ($_SESSION["mail"]) echo $_SESSION["mail"];?>" required/><br />
		<label for="pass">Password</label><br />
		<input type="password" id="pass" name="pass" value="" required/><br />
		<label for="cpass">Password</label><br />
		<input type="password" id="cpass" name="cpass" value="" required/><br />
		<input type="submit" value="Gonna catch'em all" />
		</form>	
	</div>
<?php
include("includes/bottom.php");
?>
