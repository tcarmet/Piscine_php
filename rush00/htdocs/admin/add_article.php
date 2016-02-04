<?php
	session_start();
	require ('../functions.php');
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
			<form action="process/articles.php" method="POST">
				<label for="login">Login: </label><br>
				<input type="text" name="title" id="login" autofocus required>
				<br><br>
				
				<label for="Prenom">Prénom: </label><br>
				<input type="text" name="firstname" id="Prenom" required>
				<br><br>
				
				<label for="Nom">Nom: </label><br>
				<input type="text" name="name" id="Nom" required>
				<br><br>
				
				<label for="Description">Description: </label><br>
				<input type="text" name="desc" id="Description" required>
				<br><br>
				
				<label for="Age">Age: </label><br>
				<input type="text" name="age" id="Age" required>
				<br><br>
				
				<label for="Prix">Prix: </label><br>
				<input type="text" name="price" id="Prix" required>
				<br><br>
				
				<?php
					foreach ($cats as $key => $value)
					{
						echo "<label for=\"".$value."\">".$value."</label>";
						echo "<input type=\"checkbox\" name=\"categories\" id=\"".$value."\" value=\"".$key."\" onclick=\"verifie_check_box(".$key.")\">";
						if ($key == 3 || $key == 5)
							echo "<br /><br />";
					}
				?>
				<br /><br />
				<table class="table_article_add">
				<?php
					foreach ($color as $k_color => $val_col)
					{
						echo "<tr><td><label for=\"".$val_col."_color\">".$val_col." </label></td>";
						echo "<td><input type=\"checkbox\" name=\"colors\" id=\"".$val_col."_color\" value=\"".$k_color."\" required class=\"colors\" onclick=\"check_box_color(".$k_color.")\"></td>";
						echo "<td id=\"".$k_color."_td\" style=\"display: none;\"><label for=\"".$val_col."stock\">Stock: </label>";
						echo "<input type=\"text\" name=\"".$k_color."_stock\" id=\"".$val_col."_stock\"></td></tr>";
					}
				?>
				</table>
				<br />
				<a href=""
				<input type="submit" name="submit" value="Ajouter">
			</form>
		</div>
		<script src="../js/main.js"></script>
	</body>	
</html>