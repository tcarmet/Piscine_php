#!/usr/bin/php
<?php
	foreach ($argv as $i => $value) 
	{
		if ($i == 0)
			$i++;
		else
		{
			echo "$value\n";
			$i++;
		}
	}
?>