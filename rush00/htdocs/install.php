<?php
	require ('./functions.php');

	$servername = "localhost:3306";
	$username = "root";
	$password = "ecole42";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
	    echo "Connection failed: " . mysqli_connect_error()."</span><br />";
	}

	// Create database
	$sql = "CREATE DATABASE 42shop";
	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating database: " . mysqli_error($conn)."</span><br />";
	}

	$conn = mysqli_connect($servername, $username, $password, '42shop');
	// Check connection
	if (!$conn) {
	    echo "Connection failed: " . mysqli_connect_error();
	}

	// Create administrators table
	$sql = "CREATE TABLE IF NOT EXISTS `administrators` (
			  `id_administrators` int(11) NOT NULL,
			  `login` varchar(30) NOT NULL,
			  `password_adm` text NOT NULL,
			  `email_adm` varchar(255) NOT NULL,
			  `id_rank` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table administrators created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create articles table
	$sql = "CREATE TABLE IF NOT EXISTS `articles` (
			  `id_articles` int(11) NOT NULL,
			  `title` varchar(20) NOT NULL,
			  `firstname_articles` varchar(50) NOT NULL,
			  `name_articles` varchar(50) NOT NULL,
			  `desc_articles` text NOT NULL,
			  `age` int(11) NOT NULL,
			  `price` int(11) NOT NULL,
			  `pool` int(11) NOT NULL,
			  `year` int(11) NOT NULL,
			  `gender` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table articles created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create available_in table
	$sql = "CREATE TABLE IF NOT EXISTS `available_in` (
			  `id_available` int(11) NOT NULL,
			  `id_color` int(11) NOT NULL,
			  `id_article` int(11) NOT NULL,
			  `stock` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table available_in created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create belong table
	$sql = "CREATE TABLE IF NOT EXISTS `belong` (
			  `id_belong` int(11) NOT NULL,
			  `id_categorie` int(11) NOT NULL,
			  `id_article` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table belong created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create categories table
	$sql = "CREATE TABLE IF NOT EXISTS `categories` (
			  `id_categories` int(11) NOT NULL,
			  `name_categories` varchar(15) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table categories created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create colors table
	$sql = "CREATE TABLE IF NOT EXISTS `colors` (
			  `id_colors` int(11) NOT NULL,
			  `name_colors` varchar(20) NOT NULL,
			  `val_hex` varchar(6) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table colors created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create commands table
	$sql = "CREATE TABLE IF NOT EXISTS `commands` (
			  `id_commands` int(11) NOT NULL,
			  `date_commands` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `id_cus` int(11) NOT NULL,
			  `id_state_cmd` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table commands created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create contain table
	$sql = "CREATE TABLE IF NOT EXISTS `contain` (
			  `id_contain` int(11) NOT NULL,
			  `id_command` int(11) NOT NULL,
			  `id_article` int(11) NOT NULL,
			  `color_article` int(11) NOT NULL,
			  `amount` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table contain created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create customers table
	$sql = "CREATE TABLE IF NOT EXISTS `customers` (
			  `id_customers` int(11) NOT NULL,
			  `civilite` varchar(3) NOT NULL,
			  `firstname_cus` varchar(30) NOT NULL,
			  `name_cus` varchar(50) NOT NULL,
			  `email_cus` varchar(255) NOT NULL,
			  `password_cus` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table customers created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create order table
	$sql = "CREATE TABLE IF NOT EXISTS `order` (
			  `id_order` int(11) NOT NULL,
			  `id_commands` int(11) NOT NULL,
			  `id_customers` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table order created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create promos table
	$sql = "CREATE TABLE IF NOT EXISTS `promos` (
			  `id_promos` int(11) NOT NULL,
			  `code_promo` varchar(20) NOT NULL,
			  `id_article` int(11) NOT NULL,
			  `reduc` int(11) NOT NULL,
			  `active` int(11) NOT NULL DEFAULT '1'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table promos created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create rank table
	$sql = "CREATE TABLE IF NOT EXISTS `ranks` (
			  `id_ranks` int(11) NOT NULL,
			  `ranks_name` varchar(50) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table rank created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create state_articles table
	$sql = "CREATE TABLE IF NOT EXISTS `states_articles` (
			  `id_states_art` int(11) NOT NULL,
			  `state_art` varchar(50) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table states_articles created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Create state_commands table
	$sql = "CREATE TABLE IF NOT EXISTS `states_commands` (
			  `id_states_cmds` int(11) NOT NULL,
			  `state_cmds` varchar(70) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Table states_commands created successfully.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error creating table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for administrators
	$sql = "ALTER TABLE `administrators`
  			  ADD PRIMARY KEY (`id_administrators`), ADD UNIQUE KEY `login` (`login`), ADD UNIQUE KEY `email` (`email_adm`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table administrators successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for articles
	$sql = "ALTER TABLE `articles`
			  ADD PRIMARY KEY (`id_articles`), ADD UNIQUE KEY `title` (`title`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table articles successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for available_in
	$sql = "ALTER TABLE `available_in`
			  ADD PRIMARY KEY (`id_available`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table available_in successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for belong
	$sql = "ALTER TABLE `belong`
			  ADD PRIMARY KEY (`id_belong`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table belong successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for categories
	$sql = "ALTER TABLE `categories`
			  ADD PRIMARY KEY (`id_categories`), ADD UNIQUE KEY `name_categories` (`name_categories`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table categories successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for colors
	$sql = "ALTER TABLE `colors`
			  ADD PRIMARY KEY (`id_colors`), ADD UNIQUE KEY `name_colors` (`name_colors`), ADD UNIQUE KEY `val_hex` (`val_hex`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table colors successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for commands
	$sql = "ALTER TABLE `commands`
			  ADD PRIMARY KEY (`id_commands`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table commands successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for contain
	$sql = "ALTER TABLE `contain`
			  ADD PRIMARY KEY (`id_contain`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table contain successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for customers
	$sql = "ALTER TABLE `customers`
			  ADD PRIMARY KEY (`id_customers`), ADD UNIQUE KEY `email` (`email_cus`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table customers successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for order
	$sql = "ALTER TABLE `order`
			  ADD PRIMARY KEY (`id_order`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table order successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for promos
	$sql = "ALTER TABLE `promos`
			  ADD PRIMARY KEY (`id_promos`), ADD UNIQUE KEY `code_promo` (`code_promo`), ADD UNIQUE KEY `active` (`active`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table promos successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for ranks
	$sql = "ALTER TABLE `ranks`
			  ADD PRIMARY KEY (`id_ranks`), ADD UNIQUE KEY `ranks_name` (`ranks_name`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table ranks successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for states_articles
	$sql = "ALTER TABLE `states_articles`
			  ADD PRIMARY KEY (`id_states_art`), ADD UNIQUE KEY `state_art` (`state_art`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table states_articles successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Index for states_commands
	$sql = "ALTER TABLE `states_commands`
			  ADD PRIMARY KEY (`id_states_cmds`), ADD UNIQUE KEY `state_cmds` (`state_cmds`)";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Index of table states_commands successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error index table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for administrators
	$sql = "ALTER TABLE `administrators`
			  MODIFY `id_administrators` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table administrators successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for articles
	$sql = "ALTER TABLE `articles`
			  MODIFY `id_articles` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table articles successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for available_in
	$sql = "ALTER TABLE `available_in`
			  MODIFY `id_available` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table available_in successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for belong
	$sql = "ALTER TABLE `belong`
			  MODIFY `id_belong` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table belong successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for categories
	$sql = "ALTER TABLE `categories`
			  MODIFY `id_categories` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table categories successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for colors
	$sql = "ALTER TABLE `colors`
			  MODIFY `id_colors` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table colors successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for commands
	$sql = "ALTER TABLE `commands`
			  MODIFY `id_commands` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table commands successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for contain
	$sql = "ALTER TABLE `contain`
			  MODIFY `id_contain` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table contain successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for customers
	$sql = "ALTER TABLE `customers`
			  MODIFY `id_customers` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table customers successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for order
	$sql = "ALTER TABLE `order`
			  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table order successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for promos
	$sql = "ALTER TABLE `promos`
			  MODIFY `id_promos` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table promos successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for ranks
	$sql = "ALTER TABLE `ranks`
			  MODIFY `id_ranks` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table ranks successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for states_articles
	$sql = "ALTER TABLE `states_articles`
			  MODIFY `id_states_art` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table states_articles successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	// Auto-increment for states_commands
	$sql = "ALTER TABLE `states_commands`
			  MODIFY `id_states_cmds` int(11) NOT NULL AUTO_INCREMENT";

	if (mysqli_query($conn, $sql) === TRUE) {
	    echo "Auto-increment of table states_commands successfully add.<br />";
	} else {
	    echo "<span style=\"color: red;\">Error auto-increment table: " . mysqli_error($conn)."</span><br />";
	}

	mysqli_close($conn);

	filled_bdd("categories");
	filled_bdd("admin");
	filled_bdd("customers");
	filled_bdd("articles");
	filled_bdd("states_commands");
	filled_bdd("states_articles");
	filled_bdd("colors");
?>