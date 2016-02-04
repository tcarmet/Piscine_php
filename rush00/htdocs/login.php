<?php
	if (!isset($_SESSION["id_customer"]))
	{
?>
		<form action="process/login_process.php" class="usrpl" method="POST">
			<label for="usr">E-Mail</label><br />
			<input type="email" id="usr" name="mail" value="<?php if ($_SESSION["mail"]) echo $_SESSION["mail"];?>" required/><br />
			<label for="pass">Password</label><br />
			<input type="password" id="pass" name="pass" value="" required/><br />
			<input type="submit" value="Log in" />
		</form>
		<a class="signn" href="./index.php?pg=sign_in">Devenir client</a>
		<?php
		}
		else
		{
		?>
		<div class="usrpl">
			<div>
				<?php
					echo $_SESSION['civilite_customer']." ".$_SESSION['name_customer']." ".$_SESSION['firstname_customer'];
				?><hr/>
			</div>
			<div class="lusr">
			<br />
				<?php echo $_SESSION["email_customer"]."<br />";?>
				<a href="./index.php?pg=panier">Mon panier</a><br />
				<a href="./index.php?pg=commande">Mes commandes</a><br />
			</div>
			<div class="rusr">
				<div>
				<?php
				    $totk = 0;
				    $totc = 0;
				    $totn = 0;
				    foreach ($_SESSION["panier"] as $elem)
				    {
				        $totk = $totk + $elem["kebab"] * $elem["nb"];
				        $totc = $totc + $elem["cafe"] * $elem["nb"];
				    }
				    $totk = $totk + intval($totc / 10);
				    $totc = intval($totc % 10);
				    echo $totk."K ".$totc."C";
				?>
				</div>
				<div>
				<a href="./?pg=panier">
					<img class="panier" src="img/panier.png" />
				</a>
				</div>
			</div>
			<div>
				<a class="unlog" href="./logout.php">Deconnexion</a>
			</div>
		</div>
<?php
	}
?>
