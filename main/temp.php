<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Message Bee </title>
    <script src="https://kit.fontawesome.com/a81e295c63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    include "../connection.php";
    session_start();
    $sender_id = $_SESSION['accountId'];
    if (isset($_GET['receiver'])) {
        $receiver_id = $_GET['receiver'];
    }
    $sql1 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$sender_id}'");
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
                <div class="profile-picturer"><img class="profile-pic" src="<?php echo $receiver_profile;  ?>" alt=""></div>
                <div class="name-status">
                    <div class="name-modal"><?php echo "$receiver_first_name $receiver_last_name";  ?></div>
                    <div class="status"><?php echo $receiver_status; ?></div>
                </div>
            </div>
            <div class="menu-bar menus"><i class="fas fa-bars"></i></div>
        </div>
        <div class="side-navigations" id="navigation">
            <div class="menues">
                <a class="menues-item" href="homePage.php">Home</a>
            </div>
            <div class="menues add-contracts-option">
                Delete Conversation
            </div>
            <div class="menues">
                <a class="menues-item" href="">Remove contract</a>
            </div>
            <div class="menues">
                <a class="menues-item" href="">Settings</a>
            </div>
            <div class="menues logOut">
                <a class="menues-item" href="singIn.php">Log out</a>
            </div>
        </div>
        <div class="contract-field fild2 messages">
            <?php
            $sql13 = mysqli_query($conn, "SELECT*FROM `$sender_id` WHERE relation ='temp'");
            if ($sql13) {
                if (mysqli_num_rows($sql13) > 0) {
                    while ($cntx = mysqli_fetch_assoc($sql13)) {
                        $sql4 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$cntx['contracts']}'");
                        if ($sql4) {
                            while ($cntxs = mysqli_fetch_assoc($sql4)) {

            ?>
                                <div class="contracts" style="display:flex">
                                    <form action="messageBox.php" method="post">
                                        <input type="hidden" name="sender-ids" value="<?php echo $sender_id; ?>">
                                        <input type="hidden" name="receiver-ids" value="<?php echo $cntx['contracts']; ?>">
                                        <button type="submit" class="users-button ub2" name="users-ids-button" style="width:235px">
                                            <div class="profile-picture profile-picturess" style="background-image:url('<?php echo $cntxs['profile_pic']; ?>')">
                                                <?php
                                                $color = "";
                                                $active = $cntxs['status'];
                                                if ($active == "Offline now") {
                                                    $color = "#333";
                                                }
                                                ?>
                                                <div class="transfrom" style="background-color:<?php echo $color; ?>"></div>
                                            </div>
                                            <div class="contracts-name">
                                                <div class="name-message-area">
                                                    <div class="profile-name-preview">
                                                        <?php
                                                        echo $cntxs['first_name'] . " " . $cntxs['last_name'];
                                                        ?>
                                                    </div>
                                                    <div class="message-preview-con" style="margin:2px 0;">Send you add request</div>
                                                </div>
                                            </div>
                                        </button>
                                    </form>
                                    <div class="relation_varify">
                                        <form action="add.php" method="post">
                                            <input type="hidden" name="location" value="temp.php">
                                            <input type="hidden" name="senders_id" value="<?php echo $sender_id; ?>">
                                            <input type="hidden" name="receivers_id" value="<?php echo $cntx['contracts']; ?>">
                                            <button type="submit" name="acceptrequest" class="addperson " style="margin:10px 0 0 0; width:60px;">Accept</button>
                                        </form>
                                    </div>
                                    <div class="relation_varify">
                                        <form action="add.php" method="post">
                                            <input type="hidden" name="location" value="temp.php">
                                            <input type="hidden" name="senders_id" value="<?php echo $sender_id; ?>">
                                            <input type="hidden" name="receivers_id" value="<?php echo $cntx['contracts']; ?>">
                                            <button type="submit" name="cencelrequest" class="addperson " style="margin:10px 0 0 0; width:60px;">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                } else {
                    ?>
                    <div class="contracts">
                        <p class="notice" style="margin-top:200px">Request not found yet.</p>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="contracts">
                    <p class="notice" style="margin-top:200px">Request not found yet.</p>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="text-area">
            <div class="not_permit">
                You can't send message to the contract.
            </div>
        </div>
    </div>
    <script src="../javascript/chat.js"></script>
    <script src="../javascript/mainMSgBox.js"></script>
</body>

</html>