#!/usr/bin/php
<?php

if ($argc < 3)
    exit(-1);
for ($i = 2; $argv[$i]; $i += 1) {
    $tab[] = explode(":", $argv[$i]);
}
for ($i = 0; $tab[$i]; $i++) {
    $hash[$tab[$i][0]] = $tab[$i][1];
}
if (empty($hash[$argv[1]]))
    exit;
print("{$hash[$argv[1]]}\n");
?>
