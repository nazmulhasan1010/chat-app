<?php
include "../connection.php";
$account_id = mysqli_real_escape_string($conn, $_POST['receive_id']);
$sql3 = mysqli_query($conn, "SELECT*FROM `$account_id`");
if (mysqli_num_rows($sql3) > 0) {
    if ($sql3) {
        while ($account_id_row = mysqli_fetch_assoc($sql3)) {
            $sql4 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$account_id_row['contracts']}'");
            if ($sql4) {
                while ($cntx = mysqli_fetch_assoc($sql4)) {
                    if ($cntx['unique_id'] == $account_id) {
                    } else {
                        $sql14 = mysqli_query($conn, "SELECT*FROM `$account_id` WHERE contracts = '{$cntx['unique_id']}'");
                        if ($sql14) {
                            if (mysqli_num_rows($sql14) > 0) {
                                while ($rowss = mysqli_fetch_assoc($sql14)) {
                                    $relation = $rowss['relation'];
                                }
                            } else {
                                $relation = "unknown";
                            }
                        } else {
                            $relation = "unknown";
                        }


                        if ($relation == "unknown") {
                            $relations = "unknown";
                        }
                        if ($relation == "temp") {
                            $relations = $cntx['first_name'] . " " . $cntx['last_name'] . "send you add request";
                        }
                        if ($relation == "waiting") {
                            $relations = "request sended";
                        }
                        if ($relation == "friend") {
                            $relations = "friend";
                        }
?>
                        <div class="contracts" style="padding:0px;height:60px; display:flex">
                            <form action="messageBox.php" method="post">
                                <input type="hidden" name="sender-ids" value="<?php echo $account_id; ?>">
                                <input type="hidden" name="receiver-ids" value="<?php echo $cntx['unique_id'] ?>">
                                <button type="submit" class="users-button ub2" name="users-ids-button" style="width:300px;">
                                    <div class="profile-picture profile-picturess" style="background-image:url('<?php echo $cntx['profile_pic']; ?>')">
                                        <?php
                                        if ($relation == 'friend') {

                                            $color = "";
                                            $active = $cntx['status'];
                                            if ($active == "Offline now") {
                                                $color = "#333";
                                            }
                                        ?>
                                            <div class="transfrom" style="background-color:<?php echo $color; ?>"></div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="transfrom" style="background:none; border:none"></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="contracts-name">
                                        <div class="name-message-area">
                                            <div class="profile-name-preview">
                                                <?php
                                                echo $cntx['first_name'] . " " . $cntx['last_name'];
                                                ?>
                                            </div>
                                            <div class="message-preview-con" style="margin:2px 0;"><?php echo $relations; ?></div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                            <?php
                            if ($relation == "unknown") {
                            ?>
                                <form action="add.php" method="post">
                                    <input type="hidden" name="location" value="homePage.php">
                                    <input type="hidden" name="senders_id" value="<?php echo $account_id; ?>">
                                    <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                                    <button type="submit" name="addperson" class="addperson addpersons">Add</button>
                                </form>
                            <?php
                            }
                            if ($relation == "temp") {
                            ?>
                                <form action="add.php" method="post">
                                    <input type="hidden" name="location" value="homePage.php">
                                    <input type="hidden" name="senders_id" value="<?php echo $account_id; ?>">
                                    <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                                    <button type="submit" name="acceptrequest" class="addperson addpersons">Accept</button>
                                </form>
                            <?php
                            }
                            if ($relation == "friend") {
                            ?>
                                <form action="add.php" method="post">
                                    <input type="hidden" name="location" value="homePage.php">
                                    <input type="hidden" name="senders_id" value="<?php echo $account_id; ?>">
                                    <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                                    <button type="submit" name="cencelrequest" class="addperson addpersons">Unfriend</button>
                                </form>
                            <?php
                            }
                            if ($relation == "waiting") {
                            ?>
                                <form action="add.php" method="post">
                                    <input type="hidden" name="location" value="homePage.php">
                                    <input type="hidden" name="senders_id" value="<?php echo $account_id; ?>">
                                    <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                                    <button type="submit" name="cencelrequest" class="addperson addpersons">Cencel</button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
    <?php
                    }
                }
            }
        }
    }
} else {
    ?>
    <div class="contracts">
        <p class="notice" style="margin-top:200px">No users connect to you.</p>
    </div>
<?php
}

?>