#!/usr/bin/php
<?php
	foreach ($argv as $i => $value) 
	{
		if ($i == 1)
		{
			$tab = explode(" ", $value);
			foreach ($tab as $key => $val) 
			{
				if (empty($val))
					unset($tab[$key]);
				else if ($key >= 1)
					echo "$val ";
			}
			echo $tab[0]."\n";
		}
	}
?>