#!/usr/bin/php
<?php
	$i = 0;
	$va = array();
	if ($argc > 2)
	{
		echo "Incorrect Parameters\n";
		exit(-1);
	}
	while ($argv[1][$i] || $argv[1][$i] === '0')
	{
		if ($argv[1][$i] != ' ')
			$va[] = $argv[1][$i];
		$i++;
	}
	$i = 0;
	if ($va[$i] == "-")
	{
	 	$number1 = "-";
	 	$i++;
	}
	while (is_numeric($va[$i]))
	{
		$number1 = $number1.$va[$i];
		$i++;
	}
	$operator = $va[$i++];
	if ($va[$i] == "-")
	{
	 	$number2 = "-";
	 	$i++;
	}
	while (is_numeric($va[$i]))
	{
		$number2 = $number2.$va[$i];
		$i++;
	}
	if ($va[$i])
		$number1 = "error";
	function ft_operation($number1, $operator, $number2)
	{
		if (!is_numeric($number1) || !is_numeric($number2))
			$result = "Syntax Error";
		else if (trim($operator) == "+")
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
			$result = "Syntax Error";
		return ($result);
	}
	if ($argv[1])
		echo ft_operation($number1, $operator, $number2)."\n";
	else
		echo "Incorrect Parameters\n";
?>