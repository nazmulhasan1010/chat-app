<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Message Bee </title>
    <script src="https://kit.fontawesome.com/a81e295c63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/main.css?v=<?php echo time(); ?>">
    <script src="../javascript/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php
    error_reporting(0);
    include "../connection.php";
    session_start();
    $sender_id = $_SESSION['accountId'];
    if (isset($_GET['receiver'])) {
        $receiver_id = $_GET['receiver'];
    }

    if (isset($_POST['users-ids-button'])) {
        $sender_id = $_POST['sender-ids'];
        $receiver_id = $_POST['receiver-ids'];
    }
    if (isset($_POST['send'])) {
        $text_message = $_POST['text_area'];
        $sender_id = $_POST['sender_ids'];
        $receiver_id = $_POST['receiver_ids'];
        $_SESSION['messageses'] = $text_message;
    }
    $sql1 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$receiver_id}'");
    if (mysqli_num_rows($sql1) > 0) {
        $receiver = mysqli_fetch_assoc($sql1);
        $receiver_first_name = $receiver['first_name'];
        $receiver_last_name = $receiver['last_name'];
        $receiver_profile = $receiver['profile_pic'];
        $receiver_status = $receiver['status'];
    }

    ?>
    <div class="main-stracture">
        <div class="main-header">
            <div class="back-button">
                <a href="homePage.php" style="color:black"><i class="fas fa-arrow-left" onclick="goBack()"></i></a>
            </div>
            <div class="profile-review">
                <div class="profile-picturer"><a class="profile_link" href="profiles.php?ids=<?php echo $receiver_id; ?>"><img class="profile-pic" src="<?php echo $receiver_profile;  ?>" alt=""></a></div>
                <div class="name-status">
                    <div class="name-modal"><?php echo "$receiver_first_name $receiver_last_name";  ?></div>
                    <div class="status"><?php echo $receiver_status; ?></div>
                </div>
            </div>
            <div class="menu-bar menus"><i class="fas fa-bars"></i></div>
        </div>
        <div class="side-navigation side-navigations" id="navigation">
            <div class="menuess">
                <div class="menues">
                    <a class="menues-item" href="homePage.php">Home</a>
                </div>
                <div class="menues add-contracts-option delete_conversation">
                    Delete Conversation
                </div>
                <!-- <div class="menues">
                    <a class="menues-item" href="">Remove contract</a>
                </div>
                <div class="menues">
                    <a class="menues-item" href="">Settings</a>
                </div> -->
                <div class="menues logOut">
                    <a class="menues-item" href="singIn.php">Log out</a>
                </div>
            </div>
        </div>
        <?php
        $sql13 = mysqli_query($conn, "SELECT*FROM `$sender_id`");
        if ($sql13) {
            if (mysqli_num_rows($sql13) > 0) {
                $sql14 = mysqli_query($conn, "SELECT*FROM `$sender_id` WHERE contracts = '{$receiver_id}'");
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
        ?>
        <?php
        if ($relation == "unknown") {
        ?>
            <div class="relation_varify">
                <form action="add.php" method="post">
                    <input type="hidden" name="location" value="messageBox.php">
                    <input type="hidden" name="senders_id" value="<?php echo $sender_id; ?>">
                    <input type="hidden" name="receivers_id" value="<?php echo $receiver_id; ?>">
                    This person is unknown. <button type="submit" name="addperson" class="addperson">Add</button>
                </form>
            </div>
        <?php
        }
        if ($relation == "waiting") {
        ?>
            <div class="relation_varify">
                <form action="add.php" method="post">
                    <input type="hidden" name="location" value="messageBox.php">
                    <input type="hidden" name="senders_id" value="<?php echo $sender_id; ?>">
                    <input type="hidden" name="receivers_id" value="<?php echo $receiver_id; ?>">
                    Add request sended <button type="submit" name="cencelrequest" class="addperson">Cencel</button>
                </form>
            </div>
        <?php
        }
        if ($relation == "temp") {
        ?>
            <div class="relation_varify">
                <form action="add.php" method="post">
                    <input type="hidden" name="location" value="messageBox.php">
                    <input type="hidden" name="senders_id" value="<?php echo $sender_id; ?>">
                    <input type="hidden" name="receivers_id" value="<?php echo $receiver_id; ?>">
                    <?php echo "$receiver_first_name $receiver_last_name";  ?> send you add request <button type="submit" name="acceptrequest" class="addperson">Accept</button>
                </form>
            </div>
        <?php
        }
        ?>
        <div class="contract-field fild2 messages">
        </div>
        <div class="text-area">
            <form action="" method="post" class="typing-area">
                <div class="reply_box_chat">
                    <div class="reply_with">
                        <div class="texts">Reply with</div>
                        <div class="cancel_cross"><i class="fas fa-times-circle"></i></div>
                    </div>
                    <div class="reply_box"></div>
                    <input type="hidden" class="hiddenreplytextid" name="" value="">
                </div>
                <div class="message-box">
                    <?php
                    if ($relation == "unknown") {
                    ?>
                        <div class="not_permit">
                            You can't send message to the contract.

                        </div>
                    <?php

                    } else {
                    ?>
                        <input type="hidden" class="reply_with_id" name="reply_with_id">
                        <input type="hidden" class="sessionInfo" name="session_info" value="">
                        <input type="hidden" class="sendId" name="sender_ids" value="<?php echo $sender_id; ?>">
                        <input type="hidden" class="receiveId" name="receiver_ids" value="<?php echo $receiver_id; ?>">
                        <input type="textarea" class="text-send-box" id="textsendbox" name="text_area" required autocomplete="off" placeholder="Type a message here...">
                        <button type="submit" name="send" class="text-send-button">Send</button>
                    <?php
                    }
                    ?>
                </div>
            </form>
            <div class="add-contracts-modals2 addcontractsmodals2">
                <div class="optionses optionsesn1">
                    Delete message
                </div>
                <div class="optionses optionsesn2">
                    <a href="profiles.php?ids=<?php echo $receiver_id; ?>" class="view_profile_link">View profile</a>
                </div>
                <div class="optionses optionsesn4">
                    Copy
                </div>
                <div class="optionses optionsesn5">
                    Forward
                </div>
            </div>
            <div class="add-contracts-modals2 addcontractsmodals4">
                <div class="optionses optionsesnc1">
                    Delete message
                </div>
                <div class="optionses optionsesnc2">
                    Copy
                </div>
                <div class="optionses optionsesnc3">
                    Forward
                </div>
            </div>
            <div class="add-contracts-modals2 addcontractsmodals3">
                <div class="optionses optionsesnk1">
                    Delete from you
                </div>
                <div class="optionses optionsesnk2">
                    Delete from everyone
                </div>

            </div>
            <div class="add-contracts-modals2 addcontractsmodals6">
                <div class="forward_header">
                    <div class="header_forward_text">Send to</div>
                    <div class="done_button">Done</div>
                </div>
                <div class="forward_item">

                </div>
                <div class="search_people_for_forward">
                    <input type="search" name="search_people" id="search_people" placeholder="Search.." autocomplete="off">
                </div>
                <div class="peoples_for_forward">

                    <?php
                    $sql29 = mysqli_query($conn, "SELECT*FROM `$sender_id`");
                    if (mysqli_num_rows($sql29) > 0) {
                        if ($sql29) {
                            while ($account_id_row = mysqli_fetch_assoc($sql29)) {
                                $sql40 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$account_id_row['contracts']}'");
                                if ($sql40) {
                                    while ($cntxs = mysqli_fetch_assoc($sql40)) {
                                        if ($cntxs['unique_id'] == $sender_id) {
                                        } else {
                    ?>
                                            <div class="people_main">
                                                <div class="hidden_account_id_forward" style="display:none"><?php echo $cntxs['unique_id']; ?></div>
                                                <div class="hidden_account_sender_id_forward" style="display:none"><?php echo $sender_id; ?></div>
                                                <div class="profile_picture_froward" style="background-image: url(<?php echo $cntxs['profile_pic']; ?>)"></div>
                                                <div class="people_name">
                                                    <?php
                                                    echo $cntxs['first_name'] . " " . $cntxs['last_name'];
                                                    ?>
                                                </div>
                                                <button class="forward_send">Send</button>
                                            </div>
                    <?php
                                        }
                                    }
                                }
                            }
                        }
                    }

                    ?>
                </div>
            </div>

        </div>
    </div>
    <div class="status-bars" style="display:none" id="snackbar">

    </div>
    <script src="../javascript/chats.js"></script>
    <script src="../javascript/msgboxe.js"></script>
</body>

</html>