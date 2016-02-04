#!/usr/bin/php
<?php
	$str = implode(" ", $argv);
	$argv = explode(" ", $str);
	sort($argv);
	foreach ($argv as $i => $value) 
	{
		if (strcmp($argv[0], $value) == 0)
			unset($argv[$i]);
	}
	$string = implode("\n", $argv);
	if ($string)
		echo "$string\n";
?>