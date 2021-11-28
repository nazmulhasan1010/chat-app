<?php
include "../connection.php";
if (isset($_POST['delete_as_you_sender_id'])) {
    $dstatus = "deleted";
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_as_you_sender_id']);
    $sql = mysqli_query(
        $conn,
        "UPDATE `messages` SET `sender_deletion` = 'deleted' WHERE(id = '{$delete_id}')"
    );
}
if (isset($_POST['delete_everyone_id'])) {
    $dstatus = "deleted";
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_everyone_id']);
    $sql = mysqli_query(
        $conn,
        "UPDATE `messages` SET `sender_deletion` = 'deleted' WHERE(id = '{$delete_id}')"
    );
    $sq2 = mysqli_query(
        $conn,
        "UPDATE `messages` SET `receiver_deletion` = 'deleted' WHERE(id = '{$delete_id}')"
    );
}
if (isset($_POST['delete_as_you_receiver_id'])) {
    $dstatus = "deleted";
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_as_you_receiver_id']);
    $sq2 = mysqli_query(
        $conn,
        "UPDATE `messages` SET `receiver_deletion` = 'deleted' WHERE(id = '{$delete_id}')"
    );
}
if (isset($_POST['sender_idDelCon'])) {
    $senderDelConId = mysqli_real_escape_string($conn, $_POST['sender_idDelCon']);
    $receiverDelConId = mysqli_real_escape_string($conn, $_POST['receiver_idDelCon']);
    $sql = mysqli_query(
        $conn,
        "UPDATE `messages` SET `sender_deletion` = 'deleted'WHERE(sent_id = '{$senderDelConId}' and receive_id = '{$receiverDelConId}')"
    );
    $sq2 = mysqli_query(
        $conn,
        "UPDATE `messages` SET `receiver_deletion` = 'deleted' WHERE(sent_id = '{$receiverDelConId}' and receive_id = '{$senderDelConId}')"
    );
    if ($sql && $sq2) {
        header("Location: homePage.php");
    }
}
