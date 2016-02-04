<?php
session_start();
			include("functions.php");
?>
<html>
<head>
	<meta charset='UTF-8'>
	<title>42.Shop.fr</title>
	<link rel="stylesheet" type="text/css" href="./css/design.css">
	<link rel="stylesheet" media="all" href="css/login.css" />
    <link rel="stylesheet" media="all" href="css/article.css" />
    <link rel="stylesheet" media="all" href="css/panier.css" />
</head>
<body>
	<div id="global">
	<div id="header">
		<img src="./img/logo.png" />
		<div id="membre">
			<div class="ecrit">
				<?php include("./login.php"); ?>
			</div>
		</div>
		<div id="recherche">
			<p class="ecrit">
			<form>
				<input type=text style="width:80%;" name="Rechercher">
				<input type=submit value="Rechercher">
			</form>
			</p>
		</div>
	</div>
	<div id="general">
		<div id="content">
		<?php
		if ($_GET[pg] == "sign_in")
		{
			include("./sign_in.php");
		}
		if ($_GET[pg] == "single")
		{
			function totalp($nb, $k, $c)
			{
				$k = $nb * $k;
				$c = $nb * $c;
				$k += intval($c / 10);
				$c = $c % 10;
				$tot = '<h2>'.$k.'<img src="img/kebab.png" />'.$c.'<img src="img/cafe.png" /></h2>';
				return ($tot);
			}
			$tb = array();
			$tb = select_article_sql($_GET['id']);
			?>
			<div class="art">
				<img class="img_si" align="left" src="<?php echo './images/articles/'.$tb["title"].'.jpg';?>" /><br />
				<?php
				echo "<h2>".$tb['firstname']." ".$tb['name']."</h2>".totalp(1, intval($tb["price"] / 100), $tb["price"] % 100); 
				echo $tb["desc"]."<br />Age : ".$tb["age"]."<br />Annee : ".$tb["year"]."<br />Genre : ".select_categorie_sql($tb["gender"])."Piscine de : ".select_categorie_sql($tb["pool"]);
				?>
				<form action="fill.php?id=<?php echo $_GET["id"];?>" method="GET"><input type="submit" value="Ajouter au panier"/>
			</div>
			<?php
		}
		else
		{
			function totalp($nb, $k, $c)
			{
				$k = $nb * $k;
				$c = $nb * $c;
				$k += intval($c / 10);
				$c = $c % 10;
				$tot = '<h2>'.$k.'<img src="img/kebab.png" />'.$c.'<img src="img/cafe.png" /></h2>';
				return ($tot);
			}
			$tab= array();
			$tab = select_all_articles_sql();
			foreach ($tab as $key => $elem)
			{
			?>
			<div id="articles">
				<img height="100px" src="<?php echo './images/articles/'.$elem["title"].'.jpg';?>" /><br /><a href="?pg=single&id=<?php echo $key; ?>"><?php echo $elem['firstname']." ".$elem['name'] ?></a><?php echo totalp(1, intval($elem["price"] / 100), $elem["price"] % 100); ?>
				</div>
			<?php
			}
		}
		?> 
		</div>
		<div id="menu">
			<div id="promo">
				<p class="ecrit">
					<p class="text_promo">PROMOTION EXEPTIONNELLE<hr/></p>
				</p>
			</div>
			<p class="ecrit">
			<hr/><p class="text_menu">Menu</p><hr/>
			</p>
		</div>
	</div>
	<div id="pied">
		<p class="ecrit">
			<a href="index.php">Page d'accueil</a><br/>
			<hr/>
			<p class="copy">2015 &copy 42Shop.fr 
			<a href="admin/index.php">Administration</a>
			<a href="admin/index.php">Index</a>
			</p>
		</p>
	</div>
	</div>
</body>
</html>