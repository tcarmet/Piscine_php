#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
$fd = fopen("/var/run/utmpx", "r");
if (FALSE === $fd)
	exit("Error!");
$tab_tmp = array();
fread($fd, 1256);
while ($str = fread($fd, 628))
	array_push($tab_tmp, unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad", $str));
foreach ($tab_tmp as $key => $value) {
	if ((date('md', $value[time1]) == date(md)) && $value[type] == 7)
		$tab[$key] = $value[user]."  ".$value[line]."  ".date('M  j', $value[time1])." ".date('H:i', $value[time1])."\n";
}
	asort($tab);
	foreach ($tab as $value) {
		echo preg_replace('/[\x00-\x1F\x80-\xFF]/', "", $value)." \n";
	}
	fclose($fd);
?>