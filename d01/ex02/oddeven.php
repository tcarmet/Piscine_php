#!/usr/bin/php
<?php
	function ft_enter()
	{
		echo "Entrez un nombre: ";
	}
	ft_enter();
	while (42)
	{
		$line = fgets(STDIN);
		if (feof(STDIN) == TRUE)
		{
			echo("^D\n");
			exit(0);
		}
		else if (strcmp(trim($line), "0") == 0)
			echo "Le chiffre ".trim($line)." est Pair\n";
		else if (is_numeric(trim($line)) == TRUE)
		{
			echo "$int\n";
			$int = intval($line);
			if ($int % 2 == 0)
				echo "Le chiffre ".trim($int)." est Pair\n";
			else if ($int % 2 == 1)
				echo "Le chiffre ".trim($int)." est Impair\n";
		}
		else
			echo "'".trim($line)."' n'est pas un chiffre\n";
		ft_enter();
	}
?>