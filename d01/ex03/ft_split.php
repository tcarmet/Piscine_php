<?php
	function ft_split($string)
	{
		$i = 0;
		$tab = explode(" ", $string);
		foreach ($tab as $i => $value)
		{
			if (empty($value))
				unset($tab[$i]);
		}
		sort($tab);
		return($tab);
	}
?>