<?php
include "../connection.php";
$receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_ids']);
$sender_id  = mysqli_real_escape_string($conn, $_POST['sender_ids']);
$session_info = mysqli_real_escape_string($conn, $_POST['session_info']);
date_default_timezone_set("Asia/Dhaka");
$time = date("h.i a");
$date = date("d.m.y");

if ($session_info == "typing") {
    $sqli1 = mysqli_query($conn, "SELECT*FROM `session` WHERE sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}'");
    if (mysqli_num_rows($sqli1) > 0) {
        $sqli2 = mysqli_query($conn, "UPDATE `session` SET sender_session = 'typing' WHERE sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}'");
    } else {
        $sqli3 = mysqli_query($conn, "INSERT INTO `session`(sent_id, receive_id, sender_session, receiver_session ) VALUES ('{$sender_id}','{$receiver_id}','typing','empty')");
    }
} else {
    $sqli1 = mysqli_query($conn, "SELECT*FROM `session` WHERE sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}'");
    if (mysqli_num_rows($sqli1) > 0) {
        $sqli2 = mysqli_query($conn, "UPDATE `session` SET sender_session = 'typingstop' WHERE sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}'");
    } else {
        $sqli3 = mysqli_query($conn, "INSERT INTO `session`(sent_id, receive_id, sender_session, receiver_session ) VALUES ('{$sender_id}','{$receiver_id}','typing','empty')");
    }
}
