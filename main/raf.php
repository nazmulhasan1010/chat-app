<form action="messageBox.php" method="post">
    <input type="hidden" name="sender-ids" value="<?php echo $account_id; ?>">
    <input type="hidden" name="receiver-ids" value="<?php echo $cntx['unique_id'] ?>">
    <button type="submit" class="users-button" name="users-ids-button">
        <div class="profile-picture">
            <img src="<?php echo $cntx['profile_pic']; ?>" alt="" class="profile-pic active-profile" />
        </div>
        <div class="contracts-name">
            <div class="name-message-area">
                <div class="profile-name-preview">
                    <?php
                    echo $cntx['first_name'] . " " . $cntx['last_name'];
                    ?>
                </div>
                <div class="message-preview-con"><?php echo $messagerow['message']; ?></div>
            </div>
            <div class="status-area">
                <?php
                $color = "";
                $active = $cntx['status'];
                if ($active == "Offline now") {
                    $color = "#333";
                }
                ?>
                <div style="background-color:<?php echo $color; ?>" class="active-sign"></div>
            </div>
        </div>
    </button>
</form>




if ($message['sent_id'] == $sender_id or $message['receive_id'] == $sender_id) {
} elseif ($message['sent_id'] == $receiver_id or $message['receive_id'] == $receiver_id) {
} else {
if ($message['sent_id'] == $sender_id) {
$output .= '<div class="mssage-box ">
    <div class="send">
        <div class="send-modal">
            <p> ' . $message['message'] . ' </p>
        </div>
    </div>
</div>';
} else {
$output .= '
<div class="mssage-box ">
    <div class="receive">
        <div class="icon_preview">
            <img class="icon_preview" src="' . $profIcon . '">
        </div>
        <div class="receive-modal">
            <p>' . $message['message'] . '</p>
        </div>

    </div>
</div>';
}
}


echo "Account: " . $account_id . "<br>";
echo "Home: " . $home_town . "<br>";
echo "City: " . $city . "<br>";
echo "Country: " . $country . "<br>";
echo "Companey: " . $companey . "<br>";
echo "Work: " . $work . "<br>";
echo "Cirtificate: " . $cirtificate . "<br>";
echo "Institute: " . $institute . "<br>";
echo "Relation: " . $relationshio . "<br>";
echo "Edit Type: " . $edit_type . "<br>";


<div class="dot_option">
    <?php
    include "../connection.php";
    $account_id = $_SESSION['accountId'];

    $sql17 = mysqli_query($conn, "SELECT*FROM `$account_id` ORDER BY message_id DESC");
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
                            if ($messagerow['sender_deletion'] == "deleted" && $messagerow['sent_id'] == $account_id) {
                            } elseif ($messagerow['receiver_deletion'] == "deleted" && $messagerow['receive_id'] == $account_id) {
                            } else {
                                $sql3 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$messagerow['receive_id']}' OR unique_id = '{$messagerow['sent_id']}' ORDER BY id");
                                if ($sql3) {
                                    while ($cntx = mysqli_fetch_assoc($sql3)) {
                                        if ($cntx['unique_id'] == $account_id) {
                                        } else {



    ?>
                                            <div class="dot_optionses">
                                                <form action="" method="post">
                                                    <input type="hidden" name="sender-ids" class="idSenderMain" value="<?php echo $account_id; ?>">
                                                    <input type="hidden" name="receiver-ids" class="idReceiverMain" value="<?php echo $cntx['unique_id'] ?>">
                                                    <button type="button" class="new_submit newsubmit" name="new_submit">
                                                        <i class="fad fa-ellipsis-v" style="color:#333"></i>
                                                        <div class="hiddenens"><?php echo $cntx['unique_id'] ?></div>
                                                    </button>
                                                </form>
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
        }
    }
    ?>
</div>


<script>
    //dot options
    var buttons = document.querySelectorAll(".newsubmit_button");
    var i = 0,
        length = buttons.length,
        optionsBarHidden = document.querySelector(".addcontractsmodals");
    for (i; i < length; i++) {

        buttons[i].addEventListener("click", function() {
            optionsBarHidden.style.display = 'block';
        });
    };

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("receive_id_chat=" + receive_id_chat);
</script>