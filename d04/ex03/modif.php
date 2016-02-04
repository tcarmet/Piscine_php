<?php
function islogin($login, $chain)
{
	$tab = explode("\n", $chain);
	foreach ($tab as $el)
	{
		$tb = explode(";", $el);
		foreach($tb as $elem)
		{
			$elem = unserialize($elem);
			if ($elem == $login)
				return (1);
		}
	}
	return (FALSE);
}
function chpasswd($login, $passwd, $np, $chain)
{
	$a = 0;
	$tab = explode("\n", $chain);
	$ch2 = "";
	foreach ($tab as $el)
	{
		$tb = explode(";", $el);
		foreach($tb as $elem)
		{
			$elem = unserialize($elem);
			if ($a == 1 && $elem == hash("whirlpool", $passwd))
			{
				$elem = serialize(hash("whirlpool", $np));
				$a = 2;
			}
			else if ($elem == $login)
			{
				$a = 1;
				$elem = serialize($elem);
			}
			else if ($elem)
				$elem = serialize($elem);
			if ($elem)
				$ch2 = $ch2.$elem;
		}
		if ($el)
			$ch2 = $ch2."\n";
	}
	if ($a == 2)
	{
		file_put_contents("../private/passwd", $ch2);
		return (TRUE);
	}
	return (FALSE);
}
if ($_POST['login'] && $_POST['newpw'] && $_POST['oldpw'] && $_POST['submit'])
{
	$login = $_POST['login'];
	$passwd = $_POST['newpw'];
	$oldpwd = $_POST['oldpw'];
	$submit = $_POST['submit'];
	if ($submit === "OK")
	{
		if (!file_exists("../private/passwd"))
		{
			echo "ERROR\n";
			exit ;
		}
		else
		{
			$chain = file_get_contents("../private/passwd");
			if (islogin($login, $chain) && chpasswd($login, $oldpwd, $passwd, $chain))
				echo $submit."\n";
			else
			{
				echo "ERROR\n";
				exit ;
			}
		}
	}
	else
		echo "ERROR"."\n";
}
else
	echo "ERROR"."\n";
?>