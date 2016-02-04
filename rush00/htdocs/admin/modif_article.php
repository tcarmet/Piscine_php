<?php
	session_start();
	require ('../functions.php');
	$tab = array();
	$tab = select_article_sql($_GET['id']);
	$cats = array();
	$cats = select_cat_sql();
	$color = array();
	$color = select_color_sql();
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<meta charset="utf-8">
		<title>admin</title>
	</head>
	<body>
		<?php include('includes/top.php'); ?>
		<?php include('includes/menu.php'); ?>
		<div class="content_admin">
			<form action="process/process_articles.php" method="POST">
				<label for="login">Login: </label><br>
				<input type="text" name="title" id="login" value="<?php echo $tab['title'];?>" autofocus required>
				<br><br>
				
				<label for="Prenom">Prénom: </label><br>
				<input type="text" name="firstname" id="Prenom" value="<?php echo $tab['firstname'];?>" required>
				<br><br>
				
				<label for="Nom">Nom: </label><br>
				<input type="text" name="name" id="Nom" value="<?php echo $tab['name'];?>" required>
				<br><br>
				
				<label for="Description">Description: </label><br>
				<input type="text" name="desc" id="Description" value="<?php echo $tab['desc'];?>" required>
				<br><br>
				
				<label for="Age">Age: </label><br>
				<input type="text" name="age" id="Age"  value="<?php echo $tab['age'];?>" required>
				<br><br>
				
				<label for="Prix">Prix: </label><br>
				<input type="text" name="price" id="Prix" value="<?php echo $tab['price'];?>" required>
				<br><br>
				<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
				<input type="submit" name="submit" value="Ajouter">
			</form>
		</div>
		<script src="../js/main.js"></script>
	</body>	
</html>