<?php
include "../connection.php";
date_default_timezone_set("Asia/Dhaka");
$time = date("h.i a");
$date = date("d.m.y");
$receiver_id_forward = mysqli_real_escape_string($conn, $_POST['forward_id']);
$sender_id_forward = mysqli_real_escape_string($conn, $_POST['forward_sender_id']);
$forward_message = mysqli_real_escape_string($conn, $_POST['forward_message']);

if ($forward_message != "" && $sender_id_forward != "" && $receiver_id_forward != "") {
    $sqli30 = mysqli_query($conn, "INSERT INTO `messages` (`sent_id`, `receive_id`, `message`, `date`, `time`) VALUES ('{$sender_id_forward}', '{$receiver_id_forward}', '{$forward_message}', '{$date}', '{$time}')");
    if ($sqli30) {
        $sqli1 = mysqli_query($conn, "SELECT*FROM `$receiver_id_forward` WHERE contracts ='{$sender_id_forward}'");
        if (mysqli_num_rows($sqli1) > 0) {
            $sqli2 = mysqli_query($conn, "SELECT MAX(message_id) AS maxidreceive FROM `$receiver_id_forward`");
            if (mysqli_num_rows($sqli2) > 0) {
                $receiver_message_id = mysqli_fetch_assoc($sqli2)['maxidreceive'] + 1;
            } else {
            }
        } else {
        }
        $sqli3 = mysqli_query($conn, "UPDATE `$receiver_id_forward` SET message_id='{$receiver_message_id}' WHERE contracts='{$sender_id_forward}'");

        $sqli4 = mysqli_query($conn, "SELECT*FROM `$sender_id_forward` WHERE contracts ='{$receiver_id_forward}'");
        if (mysqli_num_rows($sqli4) > 0) {
            $sqli5 = mysqli_query($conn, "SELECT MAX(message_id) AS maxidsend FROM `$sender_id_forward`");
            if (mysqli_num_rows($sqli5) > 0) {
                $sender_message_id = mysqli_fetch_assoc($sqli5)['maxidsend'] + 1;
            } else {
            }
        } else {
        }
        $sqli6 = mysqli_query($conn, "UPDATE `$sender_id_forward` SET message_id='{$sender_message_id}' WHERE contracts='{$receiver_id_forward}'");
        echo "OOk";
    }
}
