<?php
	session_start();
	require ('../functions.php');
	$tab = array();
	$tab = select_all_customers_sql();
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
					if ($key == "civilite" || $key == "firstname_cus" || $key == "name_cus" || $key == "email_cus")
					echo "<td>".$val."</td>";
				}
				echo "<td><a href=\"process/del_user.php?id=".$k."\">Delete</a>";
				echo "</tr>";
			}
		?>
		</table>
		</div>
	</body>
</html>