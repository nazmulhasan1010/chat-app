<?php
include "../connection.php";

$account_id = mysqli_real_escape_string($conn, $_POST['receive_id']);
$sql7 = mysqli_query($conn, "SELECT*FROM `$account_id` ORDER BY message_id DESC");
if (mysqli_num_rows($sql7) > 0) {
    while ($accountrows = mysqli_fetch_assoc($sql7)) {
        $relation = $accountrows['relation'];
        $sql2 = mysqli_query($conn, "SELECT*FROM messages WHERE (sent_id = '{$account_id}' AND receive_id= '{$accountrows['contracts']}') OR (receive_id = '{$account_id}' AND sent_id= '{$accountrows['contracts']}')  ORDER BY id DESC LIMIT 1");
        if ($sql2) {
            if (mysqli_num_rows($sql2) > 0) {
                while ($messagerow = mysqli_fetch_assoc($sql2)) {
                    if ($messagerow['sent_id'] == $account_id) {
                        $you = "You -";
                    } else {
                        $you = "";
                    }
                    if ($messagerow['sender_deletion'] == "deleted" && $messagerow['sent_id'] == $account_id) {
                    } elseif ($messagerow['receiver_deletion'] == "deleted" && $messagerow['receive_id'] == $account_id) {
                    } else {
                        $sql3 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$messagerow['receive_id']}' OR unique_id = '{$messagerow['sent_id']}' ORDER BY id");
                        if ($sql3) {
                            while ($cntx = mysqli_fetch_assoc($sql3)) {
                                if ($cntx['unique_id'] == $account_id) {
                                } else {


?>
                                    <div class="contress_items">
                                        <div class="button_areas">
                                            <form class="button_areas_form" action="messageBox.php" method="post">
                                                <input type="hidden" name="sender-ids" value="<?php echo $account_id; ?>">
                                                <input type="hidden" name="receiver-ids" value="<?php echo $cntx['unique_id'] ?>">
                                                <button type="submit" class="users-button" name="users-ids-button">
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
                                                        <div class="profile-name-preview">
                                                            <?php
                                                            echo $cntx['first_name'] . " " . $cntx['last_name'];
                                                            ?>
                                                            <?php
                                                            $session = "";
                                                            $sqli14 = mysqli_query($conn, "SELECT*FROM `session` WHERE sent_id ='{$accountrows['contracts']}' AND receive_id ='{$account_id}'");
                                                            if (mysqli_num_rows($sqli14) > 0) {
                                                                while ($sessionRows = mysqli_fetch_assoc($sqli14)) {
                                                                    $session = $sessionRows['sender_session'];
                                                                    $sender_session_id = $sessionRows['sent_id'];
                                                                }
                                                            }

                                                            if ($session == "typing") {
                                                                if ($sender_session_id !== $account_id) {
                                                            ?>
                                                                    <div class="message-preview-con">
                                                                        <?php echo "Typing.."; ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="message-preview-con">
                                                                    <?php
                                                                    $timecon = $messagerow['time'];
                                                                    include "time.php";
                                                                    $stringMessage = $messagerow['message'];
                                                                    $messageLen = strlen("$stringMessage");
                                                                    if ($messageLen < 35) {
                                                                        echo $you . " " . $messagerow['message'] . " " . " " . $time;
                                                                    } else {
                                                                        $cutedMessage = substr("$stringMessage", 0, 35);
                                                                        echo $you . " " . $cutedMessage . "..." . " " . "  " . $time;
                                                                    }

                                                                    ?>
                                                                </div>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>


                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="dot_optionses">
                                            <button type="button" class="new_submit newsubmit_button" name="new_submit">
                                                <i class="fas fa-ellipsis-v" style="color:#333"></i>
                                                <div class="hiddenens"><?php echo $cntx['unique_id'] ?></div>
                                            </button>


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
    }
} else {
    ?>
    <p class=" notic">No users connect to you
    </p>
<?php
}
if (isset($_POST['new_submit'])) {
    $receivers_ids = $_POST['receiver-ids-dot'];
    echo $receivers_ids;
}
?>
<script>
    var buttons = document.querySelectorAll(".newsubmit_button");
    var i = 0,
        length = buttons.length,
        optionsBarHidden = document.querySelector(".addcontractsmodals");

    for (i = 0; i < length; i++) {
        const HiddenDiv = document.querySelectorAll(".hiddenens")[i];
        buttons[i].addEventListener("click", function() {
            var text = HiddenDiv.innerHTML;
            optionsBarHidden.style.display = 'block';

            // options variable
            const optionses1 = document.querySelector(".optionses1"),
                optionses2 = document.querySelector(".optionses2"),
                optionses3 = document.querySelector(".optionses3");

            //option1
            optionses1.onclick = () => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "dotOperation.php", true);
                xhr.onload = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        location.reload();
                        if (xhr.status === 200) {
                            let data = xhr.response;
                        }
                    }
                }
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("delete_id=" + text);
            }
            // option2
            optionses2.onclick = () => {
                const linkAddress = document.querySelector('.linkAddress');
                linkAddress.href = 'profiles.php?ids=' + text;
            }

            //option3
            optionses3.onclick = () => {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "dotOperation.php", true);
                xhr.onload = () => {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            let data = xhr.response;

                        }
                    }
                }
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("unfriend_id=" + text);
            }
        });
    }
    $(document).mouseup((e) => {
        optionsBarHidden.style.display = 'none';
    });
</script>