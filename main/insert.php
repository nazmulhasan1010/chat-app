<?php
include "../connection.php";
$receiver_id = mysqli_real_escape_string($conn, $_POST['receiver_ids']);
$text_message = mysqli_real_escape_string($conn, $_POST['text_area']);
$reply_with_id = mysqli_real_escape_string($conn, $_POST['reply_with_id']);
$sender_id = mysqli_real_escape_string($conn, $_POST['sender_ids']);
date_default_timezone_set("Asia/Dhaka");
$time = date("h.i a");
$date = date("d.m.y");
if ($text_message !== "") {
    if ($reply_with_id !== "") {
        $sql4 = mysqli_query($conn, "INSERT INTO `messages` (`sent_id`, `receive_id`, `message`, `date`, `time`, `reply_with_id`) VALUES ('{$sender_id}', '{$receiver_id}', '{$text_message}', '{$date}', '{$time}','{$reply_with_id}')");
    } else {
        $sql4 = mysqli_query($conn, "INSERT INTO `messages` (`sent_id`, `receive_id`, `message`, `date`, `time`) VALUES ('{$sender_id}', '{$receiver_id}', '{$text_message}', '{$date}', '{$time}')");
    }

    if ($sql4) {
        $sqli1 = mysqli_query($conn, "SELECT*FROM `$receiver_id` WHERE contracts ='{$sender_id}'");
        if (mysqli_num_rows($sqli1) > 0) {
            $sqli2 = mysqli_query($conn, "SELECT MAX(message_id) AS maxidreceive FROM `$receiver_id`");
            if (mysqli_num_rows($sqli2) > 0) {
                $receiver_message_id = mysqli_fetch_assoc($sqli2)['maxidreceive'] + 1;
            } else {
            }
        } else {
        }
        $sqli3 = mysqli_query($conn, "UPDATE `$receiver_id` SET message_id='{$receiver_message_id}' WHERE contracts='{$sender_id}'");

        $sqli4 = mysqli_query($conn, "SELECT*FROM `$sender_id` WHERE contracts ='{$receiver_id}'");
        if (mysqli_num_rows($sqli4) > 0) {
            $sqli5 = mysqli_query($conn, "SELECT MAX(message_id) AS maxidsend FROM `$sender_id`");
            if (mysqli_num_rows($sqli5) > 0) {
                $sender_message_id = mysqli_fetch_assoc($sqli5)['maxidsend'] + 1;
            } else {
            }
        } else {
        }
        $sqli6 = mysqli_query($conn, "UPDATE `$sender_id` SET message_id='{$sender_message_id}' WHERE contracts='{$receiver_id}'");
    }
}
