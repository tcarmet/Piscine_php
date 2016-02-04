#!/usr/bin/php
<?php
if (!$argv[1])
	return ;
$handle = fopen($argv[1], "r");
$content = fread($handle, filesize($argv[1]));
fclose($handle);
$i = 0;
$f = 0;
while ($content[$i])
{
	if ($f == 3 && $content[$i] == '"')
		$f = 2;
	else if ($f == 1 && $content[$i] == 'a')
		$f = 2;
	else if ($f == 2 && $content[$i] == '"')
		$f = 3;
	else if (($f == 2 || $f == 3) && $content[$i] == '>')
		$f = 3;
	else if ($content[$i] == '<' && (($content[$i + 1] == '/' && $content[$i + 2] == 'a') || $content[$i + 1] == 'a'))
		$f = 1;
	else if ($f >= 2 && $content[$i] == '<')
		$f = 2;
	else if ($f == 3 && $content[$i] >= 'a' && $content[$i] <= 'z')
		$content[$i] = strtoupper($content[$i]);
	$i++;
}
echo $content;
?>