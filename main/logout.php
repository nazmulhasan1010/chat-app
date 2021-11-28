<?php
include "../connection.php";
$account_id = mysqli_real_escape_string($conn, $_POST['receive_id']);
$status = "Offline now";
$sql = mysqli_query($conn, "UPDATE users SET `status`='{$status}' WHERE unique_id = '{$account_id}'");
if ($sql) {
    header("Location: singIn.php");
}
