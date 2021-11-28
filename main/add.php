<?php
include "../connection.php";
if (isset($_POST['addperson'])) {
    $location = $_POST['location'];
    $receiver_id =  $_POST['receivers_id'];
    $sender_id = $_POST['senders_id'];
    $sqli1 = mysqli_query($conn, "INSERT INTO `$receiver_id`(contracts,relation)VALUES('{$sender_id}','temp')");
    if ($sqli1) {
        $sqli = mysqli_query($conn, "INSERT INTO `$sender_id`(contracts,relation)VALUES('{$receiver_id}','waiting')");
        if ($sqli) {
            header("Location:$location?receiver=$receiver_id");
        } else {
            header("Location:$location?receiver=$receiver_id");
        }
    } else {
        header("Location:$location?receiver=$receiver_id");
    }
}
if (isset($_POST['cencelrequest'])) {
    $location = $_POST['location'];
    $receiver_id =  $_POST['receivers_id'];
    $sender_id = $_POST['senders_id'];
    $sqli1 = mysqli_query($conn, "DELETE FROM `$receiver_id` WHERE contracts='{$sender_id}'");
    if ($sqli1) {
        $sqli = mysqli_query($conn, "DELETE FROM `$sender_id` WHERE contracts='{$receiver_id}'");
        if ($sqli) {
            header("Location:$location?receiver=$receiver_id");
        } else {
            header("Location:$location?receiver=$receiver_id");
        }
    } else {
        header("Location:$location?receiver=$receiver_id");
    }
}

if (isset($_POST['acceptrequest'])) {
    $location = $_POST['location'];
    $receiver_id =  $_POST['receivers_id'];
    $sender_id = $_POST['senders_id'];
    $sqli1 = mysqli_query($conn, "UPDATE `$receiver_id` SET relation = 'friend' WHERE contracts='{$sender_id}'");
    if ($sqli1) {
        $sqli = mysqli_query($conn, "UPDATE`$sender_id`SET relation = 'friend' WHERE contracts='{$receiver_id}'");
        if ($sqli) {
            header("Location:$location?receiver=$receiver_id");
        } else {
            header("Location:$location?receiver=$receiver_id");
        }
    } else {
        header("Location:$location?receiver=$receiver_id");
    }
}
