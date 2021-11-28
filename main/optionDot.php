<?php
include "../connection.php";
$account_id = $_SESSION['accountId'];

$sql17 = mysqli_query($conn, "SELECT*FROM `$account_id` ORDER BY id DESC");
if ($sql17) {
    if (mysqli_num_rows($sql17) > 0) {
        while ($accountrows = mysqli_fetch_assoc($sql17)) {
            $relation = $accountrows['relation'];
            $sql2 = mysqli_query($conn, "SELECT*FROM messages WHERE (sent_id = '{$account_id}' AND receive_id = '{$accountrows['contracts']}') OR (sent_id = '{$accountrows['contracts']}' AND receive_id = '{$account_id}')  ORDER BY id DESC LIMIT 1");
            if ($sql2) {
                if (mysqli_num_rows($sql2) > 0) {
                    while ($messagerow = mysqli_fetch_assoc($sql2)) {
                        if ($messagerow['sent_id'] == $account_id) {
                            $you = "You -";
                        } else {
                            $you = "";
                        }
                        $sql3 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$messagerow['receive_id']}' OR unique_id = '{$messagerow['sent_id']}' ORDER BY id");
                        if ($sql3) {
                            while ($cntx = mysqli_fetch_assoc($sql3)) {
                                if ($cntx['unique_id'] == $account_id) {
                                } else {



?>
                                    <div class="button_areas">
                                        <div class="status-area option_dot">
                                            <form action="" method="post">
                                                <input type="hidden" name="sender-ids" value="<?php echo $account_id; ?>">
                                                <input type="hidden" name="receiver-ids" value="<?php echo $cntx['unique_id'] ?>">
                                                <button type="submit" class="new_submit newsubmit" name="new_submit"> <i class="fas fa-ellipsis-v" style="color:#333"></i></button>
                                            </form>
                                        </div>
                                    </div>

<?php
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
    }
}
?>