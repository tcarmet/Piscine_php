<?php
	function ft_is_sort($tab)
	{
		$default = $tab;
		sort($tab);
		foreach ($tab as $key => $value) 
		{
			if ($value != $default[$key])
			{
				return FALSE;
			}
		}
		return TRUE;
	}
?>