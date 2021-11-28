<?php
include "../connection.php";
session_start();
$sender_id = $_SESSION['accountId'];
if (isset($_POST['delete_id'])) {
    $dstatus = "deleted";
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $sql = mysqli_query(
        $conn,
        "UPDATE `messages` SET `sender_deletion` = 'deleted'WHERE(sent_id = '{$sender_id}' and receive_id = '{$delete_id}')"
    );
    $sq2 = mysqli_query(
        $conn,
        "UPDATE `messages` SET `receiver_deletion` = 'deleted' WHERE(sent_id = '{$delete_id}' and receive_id = '{$sender_id}')"
    );

}
if (isset($_POST['profileView_id'])) {
    $profileView_id = mysqli_real_escape_string($conn, $_POST['profileView_id']);
    echo $profileView_id . "--view" . $sender_id;
}
if (isset($_POST['unfriend_id'])) {
    $unfriend_id = mysqli_real_escape_string($conn, $_POST['unfriend_id']);
    echo $unfriend_id . "--unfirnd" . $sender_id;
}
