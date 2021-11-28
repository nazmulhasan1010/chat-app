<?php
date_default_timezone_set("Asia/Dhaka");
$timeZone = date("h.i a");
$min_sec = explode('.', $timecon);
$min = $min_sec[0];
$sec = $min_sec[1];
$mins = str_split($min);
if ($mins['0'] == 0) {
    $minute = $mins['1'];
} else {
    $minute = $min;
}

//time
if ($minute) {
    $time = $minute . ':' . $sec;
}
