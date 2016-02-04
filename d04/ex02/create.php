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
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'])
{
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	$submit = $_POST['submit'];
	if ($submit === "OK")
	{
		if (!file_exists("../private/passwd"))
		{
			mkdir("../private", 0755);
			$chain = $chain.serialize("{").serialize("login").serialize($login).serialize("passwd").serialize(hash("whirlpool", $passwd)).serialize("}")."\n";
			file_put_contents("../private/passwd", $chain);
		}
		else
		{
			$chain = file_get_contents("../private/passwd");
			if (!islogin($login, $chain))
			{
				$chain = $chain.serialize("{").serialize("login").serialize($login).serialize("passwd").serialize(hash("whirlpool", $passwd)).serialize("}");
				file_put_contents("../private/passwd", $chain."\n");
			}
			else
			{
				echo "ERROR"."\n";
				exit ;
			}
		}
		echo $submit."\n";
	}
	else
		echo "ERROR"."\n";
}
else
	echo "ERROR"."\n";
?>