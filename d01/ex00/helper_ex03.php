#!/usr/bin/php
<?PHP
include("../ex03/ft_split.php");
unset($argv[0]);
foreach ($argv as $argument)
{
    print_r(ft_split($argument));
}
?>