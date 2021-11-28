<?php
include "../connection.php";
$account_id = mysqli_real_escape_string($conn, $_POST['receive_id']);
$sql3 = mysqli_query($conn, "SELECT*FROM `$account_id`");
if ($sql3) {
    if (mysqli_num_rows($sql3) > 0) {

        while ($account_id_row = mysqli_fetch_assoc($sql3)) {
            $sql4 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$account_id_row['contracts']}' AND status = 'Active now'");
            if ($sql4) {
                while ($actcntx = mysqli_fetch_assoc($sql4)) {
                    if ($actcntx['unique_id'] == $account_id) {
                    } else {


?>
                        <div class="actives">
                            <form action="messageBox.php" method="post">
                                <input type="hidden" name="sender-ids" value="<?php echo $account_id; ?>">
                                <input type="hidden" name="receiver-ids" value="<?php echo $actcntx['unique_id'] ?>">
                                <button type="submit" class="user-button" name="users-ids-button">
                                    <div class="profile-picture profile-pictures active-profile" style="background-image:url('<?php echo $actcntx['profile_pic']; ?>')">
                                        <?php
                                        if ($account_id_row['relation'] == 'friend') {
                                        ?>
                                            <div class="active-sign activated"></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="actives-name">
                                        <?php
                                        echo $actcntx['first_name'] . " " . $actcntx['last_name'];
                                        ?>
                                    </div>
                                </button>
                            </form>
                        </div>
        <?php
                    }
                }
            }
        }
    } else {
        ?>

        <p class="" style="color:#999999; padding:20px">No one active now</p>

<?php
    }
}
?>