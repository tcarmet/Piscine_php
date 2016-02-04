#!/usr/bin/php
<?php
	foreach ($argv as $i => $value) 
	{
		if ($i == 1)
		{
			$tab = explode(" ", $value);
			foreach ($tab as $i => $val)
			{
				if (empty($val))
					unset($tab[$i]);
			}
			$string = implode(" ", $tab);
			echo "$string\n";
		}
	}
?>