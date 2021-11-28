<?php
include "../connection.php";
error_reporting(0);
session_start();
$sender_id = $_SESSION['accountId'];
$receiver_id = mysqli_real_escape_string($conn, $_POST['receive_id_chat']);
?>
<div class="hiddenens hiden_receiver_id"><?php echo $receiver_id; ?></div>
<?php
$sql9 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$receiver_id}'");
if ($sql9) {
    $icons = mysqli_fetch_assoc($sql9);
    $profIcon = $icons['profile_pic'];
    $Fname = $icons['first_name'];
}
$sqli20 = mysqli_query($conn, "SELECT DISTINCT `date` FROM messages WHERE (sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}') OR ( sent_id = '{$receiver_id}' AND receive_id = '{$sender_id}') ORDER BY id");
if (mysqli_num_rows($sqli20) > 0) {
    while ($mainDate = mysqli_fetch_assoc($sqli20)) {
        $dateIns = $mainDate['date'];
        $sql2 = mysqli_query($conn, "SELECT*FROM messages WHERE (`date` ='{$dateIns}' AND sent_id = '{$sender_id}' AND receive_id = '{$receiver_id}') OR (`date` ='{$dateIns}' AND sent_id = '{$receiver_id}' AND receive_id = '{$sender_id}') ORDER BY id");
        // date
        $dateInse = $mainDate['date'];
        include "date.php";
?>
        <div class="date_modal"><?php echo $datek; ?> </div>
        <?php


        // messages
        while ($message = mysqli_fetch_assoc($sql2)) {
            $timecon = $message['time'];
            include "time.php";
            if ($message['sender_deletion'] == "deleted") {
                if ($message['receiver_deletion'] != "deleted") {
                    if ($message['sent_id'] == $sender_id) {
                    } else {
                        if ($message['sent_id'] == $sender_id) {
        ?>
                            <div class="mssage-boxe ">
                                <div class="message-box messageses">
                                    <div class="send">
                                        <div class="option_bar_send">
                                            <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                            <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                        </div>
                                        <div class="send-modal">
                                            <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                            <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                            <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                            <?php
                                            if ($message['reply_with_id'] != "") {
                                                $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                                if ($sqli24) {
                                                    $reply_with_message = mysqli_fetch_assoc($sqli24);
                                                }
                                                $replymessageLen = strlen($reply_with_message['message']);
                                                if ($replymessageLen < 45) {
                                                    $reply_with_message_con = $reply_with_message['message'];
                                                } else {
                                                    $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                                    $reply_with_message_con = $cutedMessage . "...";
                                                }
                                            ?>
                                                <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                            <?php
                                            }
                                            ?>
                                            <p class="text_message"> <?php echo $message['message']; ?> </p>
                                            <p class="time_modal"><?php echo $time;  ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="mssage-boxe ">
                                <div class="message-box messageses">
                                    <div class="receive_au">
                                        <div class="receive">
                                            <div class="icon_preview">
                                                <img class="icon_preview" src="<?php echo $profIcon; ?> ">
                                            </div>
                                            <div class="receive-modal">
                                                <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                                <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                                <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                                <?php
                                                if ($message['reply_with_id'] != "") {
                                                    $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                                    if ($sqli24) {
                                                        $reply_with_message = mysqli_fetch_assoc($sqli24);
                                                    }
                                                    $replymessageLen = strlen($reply_with_message['message']);
                                                    if ($replymessageLen < 45) {
                                                        $reply_with_message_con = $reply_with_message['message'];
                                                    } else {
                                                        $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                                        $reply_with_message_con = $cutedMessage . "...";
                                                    }
                                                ?>
                                                    <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                                <?php
                                                }
                                                ?>
                                                <p class="text_message"><?php echo $message['message']; ?> </p>
                                                <p class="time_modal"><?php echo $time; ?></p>
                                            </div>
                                        </div>
                                        <div class="option_bar_receive">
                                            <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                            <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
            } elseif ($message['receiver_deletion'] == "deleted") {
                if ($message['sender_deletion'] != "deleted") {
                    if ($message['receive_id'] == $sender_id) {
                    } else {
                        if ($message['sent_id'] == $sender_id) {
                        ?>
                            <div class="mssage-boxe ">
                                <div class="message-box messageses">
                                    <div class="send">
                                        <div class="option_bar_send">
                                            <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                            <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                        </div>
                                        <div class="send-modal">
                                            <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                            <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                            <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                            <?php
                                            if ($message['reply_with_id'] != "") {
                                                $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                                if ($sqli24) {
                                                    $reply_with_message = mysqli_fetch_assoc($sqli24);
                                                }
                                                $replymessageLen = strlen($reply_with_message['message']);
                                                if ($replymessageLen < 45) {
                                                    $reply_with_message_con = $reply_with_message['message'];
                                                } else {
                                                    $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                                    $reply_with_message_con = $cutedMessage . "...";
                                                }
                                            ?>
                                                <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                            <?php
                                            }
                                            ?>
                                            <p class="text_message"> <?php echo $message['message']; ?> </p>
                                            <p class="time_modal"><?php echo $time;  ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="mssage-boxe ">
                                <div class="message-box messageses">
                                    <div class="receive_au">
                                        <div class="receive">
                                            <div class="icon_preview">
                                                <img class="icon_preview" src="<?php echo $profIcon; ?> ">
                                            </div>
                                            <div class="receive-modal">
                                                <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                                <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                                <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                                <?php
                                                if ($message['reply_with_id'] != "") {
                                                    $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                                    if ($sqli24) {
                                                        $reply_with_message = mysqli_fetch_assoc($sqli24);
                                                    }
                                                    $replymessageLen = strlen($reply_with_message['message']);
                                                    if ($replymessageLen < 45) {
                                                        $reply_with_message_con = $reply_with_message['message'];
                                                    } else {
                                                        $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                                        $reply_with_message_con = $cutedMessage . "...";
                                                    }
                                                ?>
                                                    <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                                <?php
                                                }
                                                ?>
                                                <p class="text_message"><?php echo $message['message']; ?> </p>
                                                <p class="time_modal"><?php echo $time; ?></p>
                                            </div>
                                        </div>
                                        <div class="option_bar_receive">
                                            <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                            <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                }
            } elseif ($message['sender_deletion'] ==  "deleted" && $message['receiver_deletion'] == "deleted") {
            } else {

                if ($message['sent_id'] == $sender_id) {
                    ?>
                    <div class="mssage-boxe ">
                        <div class="message-box messageses">
                            <div class="send">
                                <div class="option_bar_send">
                                    <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                    <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                </div>
                                <div class="send-modal">
                                    <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                    <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                    <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                    <?php
                                    if ($message['reply_with_id'] != "") {
                                        $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                        if ($sqli24) {
                                            $reply_with_message = mysqli_fetch_assoc($sqli24);
                                        }
                                        $replymessageLen = strlen($reply_with_message['message']);
                                        if ($replymessageLen < 45) {
                                            $reply_with_message_con = $reply_with_message['message'];
                                        } else {
                                            $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                            $reply_with_message_con = $cutedMessage . "...";
                                        }
                                    ?>
                                        <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                    <?php
                                    }
                                    ?>
                                    <p class="text_message"> <?php echo $message['message']; ?> </p>
                                    <p class="time_modal"><?php echo $time;  ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {

                ?>
                    <div class="mssage-boxe ">
                        <div class="message-box messageses">
                            <div class="receive_au">
                                <div class="receive">
                                    <div class="icon_preview">
                                        <img class="icon_preview" src="<?php echo $profIcon; ?> ">
                                    </div>
                                    <div class="receive-modal">
                                        <div class="hiddenens hiden_chat_message_id"><?php echo $message['id']; ?></div>
                                        <div class="hiddenens hiden_chat_message_receiver_id"><?php echo $message['receive_id']; ?></div>
                                        <div class="hiddenens hiden_chat_message_sender_id"><?php echo $message['sent_id']; ?></div>
                                        <?php
                                        if ($message['reply_with_id'] != "") {
                                            $sqli24 = mysqli_query($conn, "SELECT*FROM messages WHERE id='{$message['reply_with_id']}'");
                                            if ($sqli24) {
                                                $reply_with_message = mysqli_fetch_assoc($sqli24);
                                            }
                                            $replymessageLen = strlen($reply_with_message['message']);
                                            if ($replymessageLen < 45) {
                                                $reply_with_message_con = $reply_with_message['message'];
                                            } else {
                                                $cutedMessage = substr($reply_with_message['message'], 0, 45);
                                                $reply_with_message_con = $cutedMessage . "...";
                                            }
                                        ?>
                                            <p class="reply_modal"><?php echo $reply_with_message_con; ?></p>
                                        <?php
                                        }
                                        ?>
                                        <p class="text_message"><?php echo $message['message']; ?> </p>
                                        <p class="time_modal"><?php echo $time; ?></p>
                                    </div>
                                </div>
                                <div class="option_bar_receive">
                                    <div class="option_icon dot_options_chat"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="option_icon reply_chat"><i class="fas fa-reply"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <script>
                // dot options executor & reply
                var buttonse = document.querySelectorAll(".dot_options_chat");
                var replyButton = document.querySelectorAll(".reply_chat");
                var i = 0,
                    lengths = buttonse.length,
                    optionsBarHiddens = document.querySelector(".addcontractsmodals2"),
                    optionsBarHiddens2 = document.querySelector(".addcontractsmodals3"),
                    optionsBarHiddens4 = document.querySelector(".addcontractsmodals4"),
                    optionsBarHiddens6 = document.querySelector(".addcontractsmodals6");


                for (i = 0; i < lengths; i++) {
                    const HiddenDiv = document.querySelectorAll(".hiden_chat_message_id")[i],
                        hidenChatReceiverId = document.querySelectorAll('.hiden_chat_message_receiver_id')[i],
                        hidenChatSenderId = document.querySelectorAll('.hiden_chat_message_sender_id')[i],
                        textMessages = document.querySelectorAll('.text_message')[i];
                    // reply option
                    replyButton[i].addEventListener("click", function() {
                        var text = HiddenDiv.innerHTML;
                        var textMessagescs = textMessages.innerHTML;
                        var textlength = textMessagescs.length;
                        if (textlength > 25) {
                            textMessagescs = textMessagescs.substring(0, 25) + "...";
                        }
                        const hiddenreplytextid = document.querySelector('.hiddenreplytextid'),
                            replyBoxesks = document.querySelector('.reply_box_chat'),
                            replyBoxesses = document.querySelector('.reply_box'),
                            text_area = document.querySelector('.text-area'),
                            text_area_height = document.querySelector('.contract-field');

                        //reply operation 
                        $('.reply_with_id').val(text);
                        text_area_height.style.height = 440 + 'px';
                        replyBoxesks.style.display = 'block';
                        replyBoxesses.innerHTML = textMessagescs;

                        //close button in reply
                        var cancelCross = document.querySelector('.cancel_cross');
                        cancelCross.onclick = () => {
                            let stexes = "";
                            $('.reply_with_id').val(stexes);
                            text_area_height.style.height = 500 + 'px';
                            replyBoxesks.style.display = 'none';
                        }

                    });
                    // navigation operation
                    const deleteConversation = document.querySelector('.delete_conversation'),
                        receiveridMain = document.querySelector('.hiden_receiver_id');
                    deleteConversation.onclick = () => {
                        $(document).ready(function() {
                            $.ajax({
                                url: 'dotOperationChat.php',
                                method: 'POST',
                                data: {
                                    sender_idDelCon: hidenChatSenderId.innerHTML,
                                    receiver_idDelCon: receiveridMain.innerHTML,
                                },
                                success: function(data) {
                                    console.log(data);
                                },
                            });
                        });
                    }
                    // dot option
                    buttonse[i].addEventListener("click", function() {
                        var hiddenQueChatSenderId = hidenChatSenderId.innerHTML;
                        var hidenReceiverId = receiveridMain.innerHTML;
                        var text = HiddenDiv.innerHTML;
                        if (hiddenQueChatSenderId === hidenReceiverId) {
                            optionsBarHiddens.style.display = 'block';
                        } else {
                            optionsBarHiddens4.style.display = 'block';
                        }

                        // options variable
                        const optionses1 = document.querySelector(".optionsesn1"),
                            optionses2 = document.querySelector(".optionsesn2"),
                            optionses3 = document.querySelector(".optionsesn3"),
                            optionses4 = document.querySelector(".optionsesn4"),
                            optionses5 = document.querySelector(".optionsesn5"),
                            optionsesc1 = document.querySelector(".optionsesnc1"),
                            optionsesc2 = document.querySelector(".optionsesnc2"),
                            optionsesc3 = document.querySelector(".optionsesnc3");

                        // ---------------------option for receiver---------------------
                        //--------------------------------------------------------------
                        //option 1 receiver 
                        optionses1.onclick = () => {
                            var hiddenQueChatReceiverId = hidenChatReceiverId.innerHTML;
                            let xhr = new XMLHttpRequest();
                            xhr.open("POST", "dotOperationChat.php", true);
                            xhr.onload = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    location.reload();
                                    if (xhr.status === 200) {
                                        let data = xhr.response;
                                    }
                                }
                            }
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.send("delete_as_you_receiver_id=" + text);
                        }

                        //otion 2 receiver 

                        // option 4 receiver
                        optionses4.onclick = () => {
                            /* Copy the text inside the text field */
                            var copyed = navigator.clipboard.writeText(textMessages.innerHTML);
                            var copystatus = copyed ? 'success' : 'fail';
                            var statusbars = document.querySelector('.status-bars');
                            if (copystatus == 'success') {
                                statusbars.style.display = 'block';
                                statusbars.innerHTML = 'Copyed';
                                setTimeout(function() {
                                    statusbars.style.display = 'none';
                                }, 1500);
                            }
                        }
                        //option 5 receiver 
                        optionses5.onclick = () => {
                            optionsBarHiddens6.style.display = 'block';
                            const done_button = document.querySelector('.done_button'),
                                itemPreview = document.querySelector('.forward_item');

                            done_button.onclick = () => {
                                optionsBarHiddens6.style.display = 'none';
                            }
                            for (i = 0; i < lengths; i++) {
                                const forwardSend = document.querySelectorAll('.forward_send')[i],
                                    hiddenAccountIdForward = document.querySelectorAll('.hidden_account_id_forward')[i],
                                    hiddenAccountSenderIdForward = document.querySelectorAll('.hidden_account_sender_id_forward')[i];
                                // forward search
                                const searchPeople = document.querySelector('#search_people'),
                                    peopleMainBox = document.querySelectorAll('.people_main'),
                                    peopleMainLength = peopleMainBox.length;
                                searchPeople.onkeyup = () => {
                                    var i = 0;
                                    for (i = 0; i < peopleMainLength; i++) {
                                        let searchTerms = searchPeople.value.toUpperCase(),
                                            peopleName = document.querySelectorAll('.people_name')[i],
                                            peopleNameUpper = peopleName.innerHTML.toUpperCase();
                                        if (peopleNameUpper.indexOf(searchTerms) > -1) {
                                            peopleMainBox[i].style.display = '';
                                        } else {
                                            peopleMainBox[i].style.display = 'none';
                                        }
                                    }

                                }
                                forwardSend.onclick = () => {
                                    let forwardIds = hiddenAccountIdForward.innerHTML,
                                        forwardSendId = hiddenAccountSenderIdForward.innerHTML;
                                    $(document).ready(function() {
                                        $.ajax({
                                            url: 'forward.php',
                                            method: 'POST',
                                            data: {
                                                forward_id: forwardIds,
                                                forward_sender_id: forwardSendId,
                                                forward_message: textMessages.innerHTML,

                                            },
                                            success: function(data) {
                                                forwardSend.style.backgroundColor = '#5f5d5d';
                                                forwardSend.innerHTML = 'Sended';
                                            },
                                        });
                                    });
                                }
                                itemPreview.innerHTML = 'Text : ' + textMessages.innerHTML;
                            }
                        }
                        // ---------------------end option for receiver ----------------
                        //--------------------------------------------------------------

                        //-------------------------- option for sender----------------
                        // -----------------------------------------------------------
                        // option 1 sender
                        optionsesc1.onclick = () => {
                            optionsBarHiddens2.style.display = 'block';
                            optionsBarHiddens4.style.display = 'none';
                            const optionsesk1 = document.querySelector(".optionsesnk1"),
                                optionsesk2 = document.querySelector(".optionsesnk2");
                            optionsesk1.onclick = () => {
                                let xhr = new XMLHttpRequest();
                                xhr.open("POST", "dotOperationChat.php", true);
                                xhr.onload = () => {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        location.reload();
                                        if (xhr.status === 200) {
                                            let data = xhr.response;

                                        }
                                    }
                                }
                                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr.send("delete_as_you_sender_id=" + text);
                            }

                            optionsesk2.onclick = () => {
                                let xhr = new XMLHttpRequest();
                                xhr.open("POST", "dotOperationChat.php", true);
                                xhr.onload = () => {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        location.reload();
                                        if (xhr.status === 200) {
                                            let data = xhr.response;
                                        }
                                    }
                                }
                                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhr.send("delete_everyone_id=" + text);
                            }
                        }
                        // option 2 sender
                        optionsesc2.onclick = () => {
                            /* Copy the text inside the text field */
                            var copyed = navigator.clipboard.writeText(textMessages.innerHTML);
                            var copystatus = copyed ? 'success' : 'fail';
                            var statusbars = document.querySelector('.status-bars');
                            if (copystatus == 'success') {
                                statusbars.style.display = 'block';
                                statusbars.innerHTML = 'Copyed';
                                setTimeout(function() {
                                    statusbars.style.display = 'none';
                                }, 1500);
                            }

                        }
                        // option 3 sender
                        optionsesc3.onclick = () => {
                            optionsBarHiddens6.style.display = 'block';
                            const done_button = document.querySelector('.done_button'),
                                itemPreview = document.querySelector('.forward_item');

                            done_button.onclick = () => {
                                optionsBarHiddens6.style.display = 'none';
                            }
                            itemPreview.innerHTML = 'Text : ' + textMessages.innerHTML;
                            // forward search
                            const searchPeople = document.querySelector('#search_people'),
                                peopleMainBox = document.querySelectorAll('.people_main'),
                                peopleMainLength = peopleMainBox.length;
                            searchPeople.onkeyup = () => {
                                var i = 0;
                                for (i = 0; i < peopleMainLength; i++) {
                                    let searchTerms = searchPeople.value.toUpperCase(),
                                        peopleName = document.querySelectorAll('.people_name')[i],
                                        peopleNameUpper = peopleName.innerHTML.toUpperCase();
                                    if (peopleNameUpper.indexOf(searchTerms) > -1) {
                                        peopleMainBox[i].style.display = '';
                                    } else {
                                        peopleMainBox[i].style.display = 'none';
                                    }
                                }

                            }
                            for (i = 0; i < peopleMainLength; i++) {
                                const forwardSend = document.querySelectorAll('.forward_send')[i],
                                    hiddenAccountIdForward = document.querySelectorAll('.hidden_account_id_forward')[i],
                                    hiddenAccountSenderIdForward = document.querySelectorAll('.hidden_account_sender_id_forward')[i];

                                forwardSend.onclick = () => {
                                    let forwardIds = hiddenAccountIdForward.innerHTML,
                                        forwardSendId = hiddenAccountSenderIdForward.innerHTML;
                                    $(document).ready(function() {
                                        $.ajax({
                                            url: 'forward.php',
                                            method: 'POST',
                                            data: {
                                                forward_id: forwardIds,
                                                forward_sender_id: forwardSendId,
                                                forward_message: textMessages.innerHTML,

                                            },
                                            success: function(data) {
                                                forwardSend.style.backgroundColor = '#5f5d5d';
                                                forwardSend.innerHTML = 'Sended';
                                            },
                                        });
                                    });
                                }
                            }
                        }
                        // ---------------------end option for sender ------------------
                        //--------------------------------------------------------------
                    });
                }
                $(document).mouseup((e) => {
                    optionsBarHiddens.style.display = 'none';
                    optionsBarHiddens2.style.display = 'none';
                    optionsBarHiddens4.style.display = 'none';

                });
            </script>
    <?php
        }
    }
} else {
    ?><p class="notice " style="margin-top:200px">No message available.</p>
<?php
}
$sqli4 = mysqli_query($conn, "SELECT*FROM `session` WHERE sent_id='{$receiver_id}'AND receive_id ='{$sender_id}' ");
if (mysqli_num_rows($sqli4) > 0) {
    while ($sessionRow = mysqli_fetch_assoc($sqli4)) {
        $session = $sessionRow['sender_session'];
        $sender_session_id = $sessionRow['sent_id'];
    }
}
?>

<?php
if ($session == "typing") {
    if ($sender_session_id !== $sender_id) {
?>
        <div class="profile_border_animate">
            <div class="icon_preview_border"></div>
            <div class="icon_preview_s ">
                <img class="icon_preview_p" src="<?php echo $profIcon; ?> ">
                <div class="session_info">
                    <?php
                    echo $Fname . " Typing...";
                    ?>
                </div>
            </div>
        </div>

<?php
    }
}
?>