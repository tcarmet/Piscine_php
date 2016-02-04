#!/usr/bin/php
<?php
	unset($argv[0]);
	$str = implode(" ", $argv);
	$argv = explode(" ", $str);
	$string_tab = array();
	$num_tab = array();
	foreach ($argv as $i => $value) 
	{
		$ord = ord($value);
		if (($ord >= 65 && $ord <= 90) || ($ord >= 97 && $ord <= 122))
		{
			$string_tab[] = $value;
			unset($argv[$i]);
		}
		else if (is_numeric($value) == TRUE)
		{
			$num_tab[] = $value;
			unset($argv[$i]);
		}
	}
	natcasesort($argv);
	rsort($num_tab);
	natcasesort($string_tab);
	$string_alpha = implode("\n", $string_tab);
	$string_etc = implode("\n", $argv);
	$string_num = implode("\n", $num_tab);
	if ($string_num || $string_alpha)
	{
		echo "$string_alpha\n";
		echo "$string_num\n";
		echo "$string_etc\n";
	}
?>