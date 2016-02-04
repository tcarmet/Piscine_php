#!/usr/bin/php
<?php
	if ($argc != 4)
	{
		print("Incorrect Parameters\n");
		exit(-1);
	}		
	function ft_operation($number1, $operator, $number2)
	{
		if (trim($operator) == "+")
			$result = "$number1" + "$number2";
		else if (trim($operator) == "-")
			$result = "$number1" - "$number2";
		else if (trim($operator) == "*")
			$result = "$number1" * "$number2";
		else if (trim($operator) == "/")
			$result = "$number1" / "$number2";
		else if (trim($operator) == "%")
			$result = "$number1" % "$number2";
		else
			$result = "Incorrect Parameters";
		return ($result);
	}
	echo ft_operation($argv[1], $argv[2], $argv[3])."\n";
?>
