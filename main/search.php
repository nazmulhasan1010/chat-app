<?php
include "../connection.php";
session_start();
$searchTerm = $_POST['searchTerm'];
$accountId = $_SESSION['accountId'];
if ($searchTerm != "") {
    $sql10 = "SELECT * FROM users WHERE NOT unique_id = {$accountId} AND (first_name LIKE '%{$searchTerm}%' OR last_name LIKE '%{$searchTerm}%') ";
    $query = mysqli_query($conn, $sql10);
    if (mysqli_num_rows($query) > 0) {
        while ($cntx = mysqli_fetch_assoc($query)) {
            $sql13 = mysqli_query($conn, "SELECT*FROM `$accountId`");
            if ($sql13) {
                if (mysqli_num_rows($sql13) > 0) {
                    $sql14 = mysqli_query($conn, "SELECT*FROM `$accountId` WHERE contracts = '{$cntx['unique_id']}'");
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
            <div class="button_areas">
                <form class="" action="messageBox.php" method="post">
                    <input type="hidden" name="sender-ids" value="<?php echo $accountId; ?>">
                    <input type="hidden" name="receiver-ids" value="<?php echo $cntx['unique_id'] ?>">
                    <button type="submit" class="users-button" name="users-ids-button" style="width:260px; background:none; padding:0px;">
                        <div class="profile-picture profile-picturess" style="background-image:url('<?php echo $cntx['profile_pic']; ?>')">
                            <div class="transfrom" style="background-color:<?php echo $color; ?>"></div>
                        </div>
                        <div class="contracts-name">
                            <div class="name-message-area">
                                <div class="profile-name-preview">
                                    <?php
                                    echo $cntx['first_name'] . " " . $cntx['last_name'];
                                    ?>
                                </div>
                                <div class="message-preview-con"><?php echo $relations; ?></div>
                            </div>
                        </div>
                    </button>
                </form>
                <?php
                if ($relation == "unknown") {
                ?>
                    <form action="add.php" method="post">
                        <input type="hidden" name="location" value="homePage.php">
                        <input type="hidden" name="senders_id" value="<?php echo $accountId; ?>">
                        <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                        <button type="submit" name="addperson" class="addperson addpersons">Add</button>
                    </form>
                <?php
                }
                if ($relation == "temp") {
                ?>
                    <form action="add.php" method="post">
                        <input type="hidden" name="location" value="homePage.php">
                        <input type="hidden" name="senders_id" value="<?php echo $accountId; ?>">
                        <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                        <button type="submit" name="acceptrequest" class="addperson addpersons">Confirm</button>
                    </form>
                <?php
                }
                if ($relation == "friend") {
                ?>
                    <form action="add.php" method="post">
                        <input type="hidden" name="location" value="homePage.php">
                        <input type="hidden" name="senders_id" value="<?php echo $accountId; ?>">
                        <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                        <button type="submit" name="cencelrequest" class="addperson addpersons">Unfriend</button>
                    </form>
                <?php
                }
                if ($relation == "waiting") {
                ?>
                    <form action="add.php" method="post">
                        <input type="hidden" name="location" value="homePage.php">
                        <input type="hidden" name="senders_id" value="<?php echo $accountId; ?>">
                        <input type="hidden" name="receivers_id" value="<?php echo $cntx['unique_id'] ?>">
                        <button type="submit" name="cencelrequest" class="addperson addpersons">Cencel</button>
                    </form>
                <?php
                }
                ?>
            </div>

        <?php
        }
    } else {
        ?>
        <div style="margin:10px; width:100%; text-align:center;">
            <?php
            echo "User not found";
            ?>
        </div>
<?php
    }
}
