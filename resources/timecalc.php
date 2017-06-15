<?php

$start = strtotime("10:20:00"); 

$end = strtotime("12:50:00"); 

$totaltime = intval($end - $start);

$hours = intval($totaltime / 3600);   
$seconds_remain = ($totaltime - ($hours * 3600)); 

$minutes = intval($seconds_remain / 60);   
$seconds = ($seconds_remain - ($minutes * 60));

echo "<br>$hours hrs $minutes mins were saved<br><br/>";

$hms = "$hours:$minutes:$seconds";
$decimalHours = decimalHours($hms);

function decimalHours($time)
{
    $hms = explode(":", $time);
    return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
}

$rph = 13;

$totalcost = $decimalHours * $rph;

echo '$' . $totalcost . ' ($13 / hour)<br/><br/>';

echo $decimalHours;

?>