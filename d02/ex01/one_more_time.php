#!/usr/bin/php
<?php
function to_day($d)
{
    $d[0] = strtolower($d[0]);
    if ($d === "lundi")
        return (1);
    if ($d === "mardi")
        return (1);
    if ($d === "mercredi")
        return (1);
    if ($d === "jeudi")
        return (1);
    if ($d === "vendredi")
        return (1);
    if ($d === "samedi")
        return (1);
    if ($d === "dimache")
        return (1);
    return (0);
}
function month($d)
{
    $d[0] = strtolower($d[0]);
    if ($d === "janvier")
        return (1);
    if ($d === "fevrier")
        return (2);
    if ($d === "mars")
        return (3);
    if ($d === "avril")
        return (4);
    if ($d === "mai")
        return (5);
    if ($d === "juin")
        return (6);
    if ($d === "juillet")
        return (7);
    if ($d === "aout")
        return (8);
    if ($d === "septembre")
        return (9);
    if ($d === "octobre")
        return (10);
    if ($d === "novembre")
        return (11);
    if ($d === "decembre")
        return (12);
    return (0);
}
if ($argv[1] === NULL)
    return ;
$t = explode(' ', $argv[1]);
$time = array_filter($t);
if ($t != $time)
{
    echo "Wrong Format\n";
    return ;
}
if (!to_day($time[0]) || !is_numeric($time[1]) || strlen($time[1]) > 2 || $time[1] > 31 || !is_numeric($time[3]) || strlen($time[3]) > 4 || $time[3] < 1970)
{
    echo "Wrong Format\n";
    return ;
}
if (!month($time[2]))
{
    echo "Wrong Format\n";
    return ;
}
$h = explode(":", $time[4]);
$h2 = array_filter($h);
if ($h != $h2)
{
    echo "Wrong Format\n";
    return ;
}
foreach ($h as $elem)
{
    if (!is_numeric($elem) || strlen($elem) != 2)
    {
        echo "Wrong Format\n";
        return ;
    }
}
if ($h[0] >= 24 || $h[1] >= 60 || $h[2] >=  60)
{
    echo "Wrong Format\n";
    return ;
}
echo (gmmktime($h[0], $h[1], $h[2], month($time[2]), $time[1], $time[3]) - 3600)."\n";
?>