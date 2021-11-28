<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prifile</title>
    <link rel="stylesheet" href="../style/profileView.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a81e295c63.js" crossorigin="anonymous"></script>
    <script src="../javascript/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php

    include "../connection.php";
    if (isset($_POST['ids'])) {
        $account_id =  mysqli_real_escape_string($conn, $_POST['ids']);
    }

    if (isset($_GET['ids'])) {
        $account_id = $_GET['ids'];
    }
    if ($account_id) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$account_id}'");
        $row = mysqli_fetch_assoc($sql);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $status = $row['status'];
        $profile_pic = $row['profile_pic'];
    }
    $sqli1 = mysqli_query($conn, "SELECT * FROM `account_info` WHERE account_num = '{$account_id}'");
    if ($sqli1) {
        if (mysqli_num_rows($sqli1) > 0) {
            $information = mysqli_fetch_assoc($sqli1);
            $edbtn = "Save Update";
            $head_box = "EDIT";
            $edit_button = "Edit your personal information";
            $color = "#333";
            $bio = $information['bio'];
            $home_town = $information['home_town'];
            $city = $information['city'];
            $country = $information['country'];
            $work = $information['work'];
            $companey = $information['company'];
            $cirtificate = $information['cirtificate'];
            $institute = $information['institute'];
            $relationshio = $information['relationship'];
        } else {
            $head_box = "ADD";
            $edbtn = "Save Information";
            $edit_button = "Add your personal information";
            $color = "";
            $bio = "";
            $home_town = "Home Town";
            $city = "City";
            $country = "Country";
            $work = "Work";
            $companey = "Companey";
            $cirtificate = "Cirtificate";
            $institute = "Institute";
            $relationshio = "Relationship";
        }
    } else {
        $head_box = "ADD";
        $edbtn = "Save Information";
        $edit_button = "Add your personal information";
        $color = "#ccc";
        $bio = "";
        $home_town = "Home Town";
        $city = "City";
        $country = "Country";
        $work = "Work";
        $companey = "Companey";
        $cirtificate = "Cirtificate";
        $institute = "Institute";
        $relationshio = "Relationship";
    }
    ?>
    <div class="main-stracture">
        <div class="optionBar">
            <div class="backButton">
                <a href="homePage.php"> <i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="moreOptions">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="profile_pic_preview" style="background-image: url(<?php echo $profile_pic; ?>);">

        </div>
        <div class="nameBox"><?php echo $first_name . " " . $last_name; ?></div>
        <?php
        if ($bio == "") {
        ?>
            <form action="" method="post" class="inputBox">
                <input type="text" name="bio" id="" class="bioBoxInput" placeholder="Add bio">
            </form>
        <?php
        } else {
        ?>
            <div class="bioBox">
                <?php echo $bio; ?>
            </div>
        <?php
        }
        ?>


        <div class="infoBox">
            <div class="info">
                <div class="headding">
                    Home
                </div>
                <div class="about" style="color:<?php echo $color; ?>">
                    <div><?php echo $home_town; ?></div>
                    <div><?php echo $city; ?></div>
                    <div><?php echo $country; ?></div>
                </div>
            </div>
            <div class="info">
                <div class="headding">
                    Work
                </div>
                <div class="about" style="color:<?php echo $color; ?>">
                    <div><?php echo $work; ?></div>
                    <div><?php echo $companey; ?></div>
                </div>

            </div>
            <div class="info">
                <div class="headding">
                    Education
                </div>
                <div class="about" style="color:<?php echo $color; ?>">
                    <div><?php echo $cirtificate; ?></div>
                    <div><?php echo $institute; ?></div>
                </div>
            </div>
            <div class="info">
                <div class="headding">
                    Relationship status
                </div>
                <div class="about" style="color:<?php echo $color; ?>"><?php echo $relationshio; ?></div>
            </div>
        </div>
        <div class="edit_profile_info">
            <form action="profileInfo.php" method="post" class="profile_edit_input_form">
                <input type="hidden" name="edit_type" value="<?php echo $head_box; ?>">
                <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
                <div class="head_box"><?php echo $head_box; ?></div>
                <div class="headding">Home</div>
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="home" id="" autocomplete="off" value="<?php echo $home_town; ?>">
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="city" id="" autocomplete="off" value="<?php echo $city; ?>">
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="country" id="" autocomplete="off" value="<?php echo $country; ?>">
                <div class="headding">Work</div>
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="work" id="" autocomplete="off" value="<?php echo $work; ?>">
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="companey" id="" autocomplete="off" value="<?php echo $companey; ?>">
                <div class="headding">Education</div>
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="cirtificate" id="" autocomplete="off" value="<?php echo $cirtificate; ?>">
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="institute" id="" autocomplete="off" value="<?php echo $institute; ?>">
                <div class="headding">Relationship status</div>
                <input type="text" class="profile_edit_input" style="color:<?php echo $color; ?>" name="relationship" id="" autocomplete="off" value="<?php echo $relationshio; ?>">
                <div class="save_btn"><input type="submit" class="edbtaes" name="submit_info" value="<?php echo $edbtn; ?>"></div>
            </form>
        </div>
        <div class="editButton">
            <button class="aboutEdit">
                <?php echo $edit_button; ?></button>
        </div>
        <?php
        $sqli = mysqli_query($conn, "SELECT*FROM `$account_id` WHERE relation ='friend'");
        if ($sqli) {
            if (mysqli_num_rows($sqli) > 0) {
                $num_of_friend = mysqli_num_rows($sqli);
        ?>
                <div class="friendsese">
                    <div class="headding2">
                        <div class="hedding_txt">
                            Friends
                        </div>
                        <div class="friends_num"> <?php echo $num_of_friend; ?> friends</div>
                    </div>
                    <div class="friendsBox">
                        <?php
                        while ($friends_id = mysqli_fetch_assoc($sqli)) {
                            $sql4 = mysqli_query($conn, "SELECT*FROM users WHERE unique_id = '{$friends_id['contracts']}'");
                            if ($sql4) {
                                while ($actcntxxx = mysqli_fetch_assoc($sql4)) {
                                    $friendfirst_name = $actcntxxx['first_name'];
                                    $friendprofile_pic = $actcntxxx['profile_pic'];
                        ?>
                                    <div class="frind">
                                        <div class="profile_picture" style="background-image: url(<?php echo $friendprofile_pic; ?>)"></div>
                                        <div class=" name"><?php echo $friendfirst_name; ?></div>
                                    </div>
                <?php
                                }
                            }
                        }
                    }
                }
                ?>

                    </div>
                </div>
    </div>
    <script>
        const infoBox = document.querySelector('.infoBox'),
            editBox = document.querySelector('.edit_profile_info'),
            editButton = document.querySelector('.editButton'),
            friendsese = document.querySelector('.friendsese');
        editButton.onclick = () => {
            infoBox.style.display = 'none';
            editBox.style.display = 'block';
            editButton.style.display = 'none';
            friendsese.style.display = 'none';
        }
    </script>
</body>

</html>