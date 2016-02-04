<?php
function auth($login, $passwd)
{
	$chain = file_get_contents("../private/passwd");
	$a = 0;
	$tab = explode("\n", $chain);
	foreach ($tab as $el)
	{
		$tb = explode(";", $el);
		foreach($tb as $elem)
		{
			$elem = unserialize($elem);
			if ($a == 1 && $elem == hash("whirlpool", $passwd))
				return (TRUE);
			else if ($elem == $login)
				$a = 1;
		}
	}
	return (FALSE);
}
?>