#!/usr/bin/php
<?PHP
include("../ex08/ft_is_sort.php");
$tab = explode(" ", $argv[1]);
if (ft_is_sort($tab))
    echo "sorted";
else
    echo "unsorted";
?>