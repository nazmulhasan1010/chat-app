<?php
include "../connection.php";
date_default_timezone_set("Asia/Dhaka");
$dateZone = date("d.m.y");
$dated = date("d");
$monthh = date("m");
$yearr = date("y");
$date_month_num = explode('.', $dateInse);
$month_num = $date_month_num[1];
$date_num = $date_month_num[0];
$year_num = $date_month_num[2];

//month
if ($month_num == 01) {
    $month_num = "Jan";
} elseif ($month_num == 02) {
    $month_num = "Feb";
} elseif ($month_num == 03) {
    $month_num = "Mar";
} elseif ($month_num == 04) {
    $month_num = "Apr";
} elseif ($month_num == 05) {
    $month_num = "May";
} elseif ($month_num == 06) {
    $month_num = "Jun";
} elseif ($month_num == 07) {
    $month_num = "Jul";
} elseif ($month_num == 8) {
    $month_num = "Aug";
} elseif ($month_num == 9) {
    $month_num = "Sep";
} elseif ($month_num == 10) {
    $month_num = "Oct";
} elseif ($month_num == 11) {
    $month_num = "Nov";
} elseif ($month_num == 12) {
    $month_num = "Dec";
}
//date
if ($dateIns == $dateZone) {
    $datek = "Today";
} elseif ($date_num == $dated - 1) {
    $datek = "Yesterday";
} elseif ($year_num == $yearr) {
    $datek = $date_num . ' ' . $month_num;
} else {
    $datek = $date_num . ' ' . $month_num . ' ' . $year_num;
}
