#!/usr/bin/php
<?php
	echo trim(preg_replace("/[ \t]+/", " ", $argv[1]))."\n";
?>