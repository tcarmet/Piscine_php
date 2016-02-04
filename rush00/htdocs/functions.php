<?php
	function connect_bdd() {
		$bdd = mysqli_connect('localhost:3306', 'root', 'ecole42', '42shop');
		return ($bdd);
	}

	function filled_bdd($file) {
		$bdd = connect_bdd();
		$insert = file('requetes/'.$file.'.txt');
		foreach ($insert as $i => $line)
		{
			if (mysqli_query($bdd, $line)) {
			    echo "Insert number ".$i." successfully.<br />";
			} else {
			    echo "Error insert ".$i." fail: " . mysqli_error($bdd)."<br />";
			}
		}
		mysqli_close($bdd);
	}

	function my_crypt($base, $key) {
		$crypt = strrev(sha1(md5(strrev($base)).$key).strrev(hash("sha512", $base.strrev($key))));
		return ($crypt);
	}

	function exec_sql($requete) {
		$bdd = connect_bdd();
		if (mysqli_query($bdd, $requete)) {
		    mysqli_close($bdd);
		    return (1);
		} else {
		    mysqli_close($bdd);
		    return (0);
		}
	}

	function protect_sql($var, $method) {
		mysqli_real_escape_string($var);
		if ($method === "intval")
		{
			$var = intval($var);
		}
		return ($var);
	}

	function signin_sql($civilite, $firstname, $name, $email, $password) {
		$civilite = protect_sql($civilite, "none");
		$firstname = protect_sql($firstname, "none");
		$name = protect_sql($name, "none");
		$email = protect_sql($email, "none");
		$password = protect_sql($password, "none");
		$sql = 'INSERT INTO customers VALUES ("", "'.$civilite.'", "'.$firstname.'", "'.$name.'", "'.$email.'", "'.$password.'")';
		if (exec_sql($sql))
			return (1);
		else
			return (0);
	}

	function add_article_sql($title, $firstname, $name, $desc, $age, $price, $categories, $stock1, $stock2, $stock3, $stock4) {
		$title = protect_sql($title, "none");
		$firstname = protect_sql($firstname, "none");
		$name = protect_sql($name, "none");
		$desc = protect_sql($desc, "none");
		$age = protect_sql($age, "intval");
		$price = protect_sql($price, "intval");
		$tab = array();
		foreach ($categories as $value)
		{
			if ($value >= 1 && $value <= 3)
			{
				$pool = $value;
				echo $pool;
				$pool = protect_sql($pool, "intval");
			}
			else if ($value >= 4 && $value <= 5)
			{
				$year = $value;
				$year = protect_sql($year, "intval");
			}
			else if ($value >= 6 && $value <= 7)
			{
				$gender = $value;
				$gender = protect_sql($gender, "intval");
			}
		}
		$stock1 = protect_sql($stock1, "intval");
		$stock2 = protect_sql($stock2, "intval");
		$stock3 = protect_sql($stock3, "intval");
		$stock4 = protect_sql($stock4, "intval");
		$sql = 'INSERT INTO articles VALUES ("", "'.$title.'", "'.$firstname.'", "'.$name.'", "'.$desc.'", "'.$age.'", "'.$price.'", "'.$pool.'", "'.$year.'", "'.$gender.'")';
		$bdd = connect_bdd();
		if (mysqli_query($bdd, $sql))
		{
		    $id = mysqli_insert_id($bdd);
			if ($stock1 >= 0)
			{
				$sql1 = 'INSERT INTO available_in VALUES ("", 1, '.$id.', '.$stock1.')';
				mysqli_query($bdd, $sql1);
			}
			if ($stock2 >= 0)
			{
				$sql2 = 'INSERT INTO available_in VALUES ("", 2, '.$id.', '.$stock2.')';
				mysqli_query($bdd, $sql2);
			}
			if ($stock3 >= 0)
			{
				$sql3 = 'INSERT INTO available_in VALUES ("", 3, '.$id.', '.$stock3.')';
				mysqli_query($bdd, $sql3);
			}
			if ($stock4 >= 0)
			{
				$sql4 = 'INSERT INTO available_in VALUES ("", 4, '.$id.', '.$stock4.')';
				mysqli_query($bdd, $sql4);
			}
			mysqli_close($bdd);
			return (1);
		} else {
			echo mysqli_error($bdd);
		    mysqli_close($bdd);
		    return (0);
		}
	}

	function delete_article_sql($id) {
		$id = protect_sql($id, "intval");
		$bdd = connect_bdd();
		$sql = 'DELETE FROM articles WHERE id_articles = "'.$id.'"';
		if (mysqli_query($bdd, $sql))
			return (1);
		else
			return (0);
	}

	function delete_customers_sql($id) {
		$id = protect_sql($id, "intval");
		$bdd = connect_bdd();
		$sql = 'DELETE FROM customers WHERE id_customers = "'.$id.'"';
		if (mysqli_query($bdd, $sql))
			return (1);
		else
			return (0);
	}

	function add_categories_sql($title, $firstname, $name, $desc, $age, $price, $categories, $stock) {
		$title = protect_sql($title, "none");
		$firstname = protect_sql($firstname, "none");
		$name = protect_sql($name, "none");
		$desc = protect_sql($desc, "none");
		$age = protect_sql($age, "intval");
		$price = protect_sql($price, "intval");
		$tab = array();
		foreach ($categories as $value)
		{
			if ($value >= 1 && $value <= 3)
			{
				$tab['pool'] = $value;
				$tab['pool'] = protect_sql($tab['pool'], "intval");
			}
			else if ($value >= 4 && $value <= 5)
			{
				$tab['year'] = $value;
				$tab['year'] = protect_sql($tab['year'], "intval");
			}
			else if ($value >= 6 && $value <= 7)
			{
				$tab['gender'] = $value;
				$tab['gender'] = protect_sql($tab['gender'], "intval");
			}
		}
		$stock = protect_sql($stock, "intval");
		$sql = 'INSERT INTO articles VALUES ("", "'.$title.'", "'.$firstname.'", "'.$name.'", "'.$desc.'", '.$age.', '.$price.', '.$tab['pool'].', '.$tab['year'].', '.$tab['gender'].', '.$stock.')';
		if (exec_sql($sql))
			return (1);
		else
			return (0);
	}

	function select_cat_sql() {
		$sql = "SELECT * FROM categories ORDER BY id_categories";
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $tab = array();
		    while ($donnees = mysqli_fetch_assoc($rtn))
		    {
		    	$tab[$donnees['id_categories']] = $donnees['name_categories'];
		    }
			mysqli_free_result($rtn);
		    mysqli_close($bdd);
		    return ($tab);
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function select_color_sql() {
		$sql = "SELECT * FROM colors ORDER BY id_colors";
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $tab = array();
		    while ($donnees = mysqli_fetch_assoc($rtn))
		    	$tab[$donnees['id_colors']] = $donnees['name_colors'];
			mysqli_free_result($rtn);
		    mysqli_close($bdd);
		    return ($tab);
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function select_color_article_sql($id) {
		$id = protect_sql($id, "intval");
		$sql = "SELECT * FROM available_in WHERE id_article = ".$id."";
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $tab = array();
		    while ($donnees = mysqli_fetch_assoc($rtn))
		    {
		    	$tab[$donnees['id_colors']] = $donnees['name_colors'];
		    }
			mysqli_free_result($rtn);
		    mysqli_close($bdd);
		    return ($tab);
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function connect_adm_sql($login, $password) {
		$login = protect_sql($login, "none");
		$password = protect_sql($password, "none");
		$sql = 'SELECT * FROM administrators WHERE login = "'.$login.'"';
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $donnees = mysqli_fetch_assoc($rtn);
		    if ($donnees['login'] == $login && $donnees['password_adm'] == $password)
		    {
		    	$_SESSION['id_admin'] = $donnees['id_administrators'];
		    	$_SESSION['login_admin'] = $donnees['login'];
		    	$_SESSION['email_admin'] = $donnees['email_adm'];
		    	$_SESSION['rank_admin'] = $donnees['id_rank'];
		    	mysqli_free_result($rtn);
			    mysqli_close($bdd);
			    return (1);
		    }
		    else
		    {
		    	mysqli_close($bdd);
		    	return (0);
		    }
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function login_sql($login, $password) {
		$login = protect_sql($login, "none");
		$password = protect_sql($password, "none");
		$sql = 'SELECT * FROM customers WHERE email_cus = "'.$login.'"';
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $donnees = mysqli_fetch_assoc($rtn);
		    if ($donnees['email_cus'] == $login && $donnees['password_cus'] == $password)
		    {
		    	$_SESSION['id_customer'] = $donnees['id_customers'];
		    	$_SESSION['civilite_customer'] = $donnees['civilite'];
		    	$_SESSION['firstname_customer'] = $donnees['firstname_cus'];
		    	$_SESSION['name_customer'] = $donnees['name_cus'];
		    	$_SESSION['email_customer'] = $donnees['email_cus'];
		    	mysqli_free_result($rtn);
			    mysqli_close($bdd);
			    return (1);
		    }
		    else
		    {
		    	mysqli_close($bdd);
		    	return (0);
		    }
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function select_categorie_sql($id)
	{
		$id = protect_sql($id, "intval");
		$bdd = connect_bdd();
		$sql = 'SELECT * FROM categories WHERE id_categories = "'.$id.'"';
		$rtn = mysqli_query($bdd, $sql);
		$donnees = mysqli_fetch_assoc($rtn);
		return ($donnees['name_categories']);
	}

	function select_article_sql($id) {
		$id = protect_sql($id, "intval");
		$bdd = connect_bdd();
		$sql = 'SELECT * FROM articles WHERE id_articles = "'.$id.'"';
		if ($rtn = mysqli_query($bdd, $sql))
		{
			$donnees = mysqli_fetch_assoc($rtn);
			$tb = array();
			$tb['title'] = $donnees['title'];
			$tb['firstname'] = $donnees['firstname_articles'];
			$tb['name'] = $donnees['name_articles'];
			$tb['desc'] = $donnees['desc_articles'];
			$tb['age'] = $donnees['age'];
			$tb['price'] = $donnees['price'];
			$tb['pool'] = $donnees['pool'];
			$tb['year'] = $donnees['year'];
			$tb['gender'] = $donnees['gender'];
			return ($tb);
		}
		else
			return (0);
	}

	function select_all_articles_sql() {
		$sql = "SELECT * FROM articles ORDER BY id_articles";
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $tab = array();
		    while ($donnees = mysqli_fetch_assoc($rtn))
		    {
		    	$tab[$donnees['id_articles']] = array();
		    	$tab[$donnees['id_articles']]['title'] = $donnees['title'];
				$tab[$donnees['id_articles']]['firstname'] = $donnees['firstname_articles'];
				$tab[$donnees['id_articles']]['name'] = $donnees['name_articles'];
				$tab[$donnees['id_articles']]['desc'] = $donnees['desc_articles'];
				$tab[$donnees['id_articles']]['age'] = $donnees['age'];
				$tab[$donnees['id_articles']]['price'] = $donnees['price'];
				$tab[$donnees['id_articles']]['pool'] = $donnees['pool'];
				$tab[$donnees['id_articles']]['year'] = $donnees['year'];
				$tab[$donnees['id_articles']]['gender'] = $donnees['gender'];
		    }
			mysqli_free_result($rtn);
		    mysqli_close($bdd);
		    return ($tab);
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function select_all_customers_sql() {
		$sql = "SELECT * FROM customers ORDER BY id_customers";
		$bdd = connect_bdd();
		if ($rtn = mysqli_query($bdd, $sql))
		{
		    $tab = array();
		    while ($donnees = mysqli_fetch_assoc($rtn))
		    {
		    	$tab[$donnees['id_customers']] = array();
		    	$tab[$donnees['id_customers']]['civilite'] = $donnees['civilite'];
				$tab[$donnees['id_customers']]['firstname_cus'] = $donnees['firstname_cus'];
				$tab[$donnees['id_customers']]['name_cus'] = $donnees['name_cus'];
				$tab[$donnees['id_customers']]['email_cus'] = $donnees['email_cus'];
		    }
			mysqli_free_result($rtn);
		    mysqli_close($bdd);
		    return ($tab);
		} else {
			mysqli_close($bdd);
		    return (0);
		}
	}

	function update_article_sql($id, $title, $firstname, $name, $desc, $age, $price)
	{
		$title = protect_sql($title, "none");
		$firstname = protect_sql($firstname, "none");
		$name = protect_sql($name, "none");
		$desc = protect_sql($desc, "none");
		$age = protect_sql($age, "intval");
		$price = protect_sql($price, "intval");
		$sql = 'UPDATE articles SET title = "'.$title.'", firstname_articles = "'.$firstname.'", name_articles = "'.$name.'", desc_articles = "'.$desc.'", age = "'.$age.'", price = "'.$price.'" WHERE id_articles = "'.$id.'"';
		$bdd = connect_bdd();
		if (mysqli_query($bdd, $sql))
		{
		    mysqli_close($bdd);
			return (1);
		} else {
			echo mysqli_error($bdd);
		    mysqli_close($bdd);
		    return (0);
		}
	}

	// function add_command_sql()
	// {
	// 	$title = protect_sql($title, "none");
	// 	$firstname = protect_sql($firstname, "none");
	// 	$name = protect_sql($name, "none");
	// 	$desc = protect_sql($desc, "none");
	// 	$age = protect_sql($age, "intval");
	// 	$price = protect_sql($price, "intval");
	// 	$tab = array();
	// 	foreach ($categories as $value)
	// 	{
	// 		if ($value >= 1 && $value <= 3)
	// 		{
	// 			$pool = $value;
	// 			echo $pool;
	// 			$pool = protect_sql($pool, "intval");
	// 		}
	// 		else if ($value >= 4 && $value <= 5)
	// 		{
	// 			$year = $value;
	// 			$year = protect_sql($year, "intval");
	// 		}
	// 		else if ($value >= 6 && $value <= 7)
	// 		{
	// 			$gender = $value;
	// 			$gender = protect_sql($gender, "intval");
	// 		}
	// 	}
	// 	$stock1 = protect_sql($stock1, "intval");
	// 	$stock2 = protect_sql($stock2, "intval");
	// 	$stock3 = protect_sql($stock3, "intval");
	// 	$stock4 = protect_sql($stock4, "intval");
	// 	$sql = 'INSERT INTO commands VALUES ("", "", "'.$firstname.'", "'.$name.'", "'.$desc.'", "'.$age.'", "'.$price.'", "'.$pool.'", "'.$year.'", "'.$gender.'")';
	// 	$bdd = connect_bdd();
	// 	if (mysqli_query($bdd, $sql))
	// 	{
	// 	    $id = mysqli_insert_id($bdd);
	// 		if ($stock1 >= 0)
	// 		{
	// 			$sql1 = 'INSERT INTO available_in VALUES ("", 1, '.$id.', '.$stock1.')';
	// 			mysqli_query($bdd, $sql1);
	// 		}
	// 		if ($stock2 >= 0)
	// 		{
	// 			$sql2 = 'INSERT INTO available_in VALUES ("", 2, '.$id.', '.$stock2.')'; 
	// 			mysqli_query($bdd, $sql2);
	// 		}
	// 		if ($stock3 >= 0)
	// 		{
	// 			$sql3 = 'INSERT INTO available_in VALUES ("", 3, '.$id.', '.$stock3.')';
	// 			mysqli_query($bdd, $sql3);
	// 		}
	// 		if ($stock4 >= 0)
	// 		{
	// 			$sql4 = 'INSERT INTO available_in VALUES ("", 4, '.$id.', '.$stock4.')';
	// 			mysqli_query($bdd, $sql4);
	// 		}
	// 		mysqli_close($bdd);
	// 		return (1);
	// 	} else {
	// 		echo mysqli_error($bdd);
	// 	    mysqli_close($bdd);
	// 	    return (0);
	// 	}
	// }
?>