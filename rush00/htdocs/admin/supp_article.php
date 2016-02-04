<?php
	session_start();
	require ('../functions.php');
	$tab = array();
	$tab = select_all_articles_sql();
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
		<table>
		<?php
			foreach ($tab as $k => $value)
			{
				echo "<tr>";
				foreach ($tab[$k] as $key => $val)
				{
					if ($key == "title" || $key == "firstname" || $key == "name" || $key == "price")
					echo "<td>".$val."</td>";
				}
				echo "<td><a href=\"process/del_articles.php?id=".$k."\">Supprimer</a>";
				echo "<td><a href=\"modif_article.php?id=".$k."\">Modifier</a>";
				echo "</tr>";
			}
		?>
		</table>
		</div>
	</body>
</html>