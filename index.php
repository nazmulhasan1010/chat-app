<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Message Bee sing up</title>
    <link rel="stylesheet" href="style/singUp.css?<?php echo time(); ?>">
    <script src="javascript/jquery-3.5.1.min.js"></script>
</head>

<body>
    <?php
    include "connection.php";
    $error = "";
    $success = $password_error = $sing_up_error = $email_error = $first_name_error = $last_name_error = "";
    $password_match = $password_validation = $email_validation = $email_unique_validation = $last_name_validation = $first_name_validation = $create_message_table = $create_contracts_table = "";
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //password_match
        $confirm_password = $_POST['confirm-password'];
        if ($password == $confirm_password) {
            $password_match = "pass";
        } else {
            $password_error = "Please Check You've Entered Or Confirmed Your Password!";
            $password_color = "red";
            $error = "error";
        }

        //password_validation
        if (strlen($password) <= '5') {
            $password_error = "Your Password Must Contain At Least 6 Characters!";
            $password_color = "red";
            $error = "error";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $password_error = "Your Password Must Contain At Least 1 Number!";
            $password_color = "red";
            $error = "error";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $password_error = "Your Password Must Contain At Least 1 Capital Letter!";
            $password_color = "red";
            $error = "error";
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $password_error = "Your Password Must Contain At Least 1 Lowercase Letter!";
            $password_color = "red";
            $error = "error";
        } else {
            $password_validation = "pass";
        }

        //email_validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            $email_validation = "pass";
            if (mysqli_num_rows($sql2) > 0) {
                $email_error = "This email already exist!";
                $email_color = "red";
                $error = "error";
            } else {
                $email_unique_validation = "pass";
            }
        } else {
            $email_error = "You Entered An Invalid Email Format";
            $email_color = "red";
            $error = "error";
        }

        //first name validation
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $first_name_error = "Only letters and white space allowed in first name";
            $first_name_color = "red";
        } else {
            $first_name_validation = "pass";
        }

        //last name validation
        if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            $last_name_error = "Only letters and white space allowed in last name";
            $last_name_color = "red";
        } else {
            $last_name_validation = "pass";
        }
        if ($password_match == "pass" and $password_validation == "pass" and $email_validation == "pass" and  $email_unique_validation == "pass" and $last_name_validation == "pass" and $first_name_validation == "pass") {

            $encypt_pass = md5($password);
            $unique_id = rand(time(), 100000000);
            $status = "Active Now";
            $sql = mysqli_query($conn, "INSERT INTO users(unique_id, first_name, last_name, email, password, status)VALUES('{$unique_id}', '{$first_name}','{$last_name}','{$email}','{$encypt_pass}', '{$status}')");
            if ($sql) {
                $nignup = "success";
            }

            $sql4 = mysqli_query($conn, "CREATE TABLE `" . $unique_id . "` (
                id INT(50) AUTO_INCREMENT PRIMARY KEY,
                contracts VARCHAR(50),
                relation VARCHAR(11),
                message_id INT(255) DEFAULT NULL
                )");
            if ($sql4) {
                $create_contracts_table = "success";
            }
            if ($create_contracts_table == "success") {
                session_start();
                $_SESSION['account_uni_id'] = $unique_id;
                header('Location: main/profile update.php');
                $success = "Sing up success";
            } else {
                $error = "error";
                $sing_up_error = "Something problem please try again!";
            }
        }
    }

    ?>
    <div class="main-form">
        <div class="header">
            <div class="header-text">
                Message Bee sing up
            </div>
        </div>
        <?php
        if ($error != "") {
            if ($sing_up_error != "") {
        ?>
                <div class="error-box"><?php echo $sing_up_error; ?></div>
            <?php
            } else {
            ?>
                <div class="error-box">
                    <ol>
                        <?php
                        if ($password_error != "") {
                        ?>
                            <li><?php echo $password_error; ?></li>
                        <?php
                        }
                        if ($email_error != "") {
                        ?>
                            <li><?php echo $email_error; ?></li>
                        <?php
                        }
                        if ($first_name_error != "") {
                        ?>
                            <li><?php echo $first_name_error; ?></li>
                        <?php
                        }
                        if ($last_name_error != "") {
                        ?>
                            <li><?php echo $last_name_error; ?></li>
                        <?php
                        }
                        ?>
                    </ol>
                </div>
            <?php
            }
        }
        if ($success != "") {
            ?>
            <div class="success-box">
                <?php echo $success; ?>
            </div>
        <?php
        }
        ?>
        <form action="#" method="post" class="input-form">
            <div class="name-input">
                <div class="name-fild">
                    <label for="first-name" style="color:<?php echo $first_name_color; ?>">First Name</label>
                    <input type="text" name="first-name" class="first-name" required autocomplete="off" placeholder="First Name">
                </div>
                <div class="name-fild">
                    <label for="last-name" style="color:<?php echo $last_name_color; ?>">Last Name</label>
                    <input type="text" name="last-name" class="last-name" required autocomplete="off" placeholder="Last Name">
                </div>
            </div>
            <div class="input-fild">
                <label for="email" style="color:<?php echo $email_color; ?>">Email Address</label>
                <input type="text" name="email" class="sing-input email" required autocomplete="off" placeholder="Email Address">
            </div>
            <div class="input-fild">
                <label for="passwoord" style="color:<?php echo $password_color; ?>"> Password</label>
                <input type="password" name="password" class="sing-input password" required autocomplete="off" placeholder="Password">
            </div>
            <div class="input-fild">
                <label for="confirm-password" style="color:<?php echo $password_color; ?>"> Confirm Password</label>
                <input type="password" name="confirm-password" class="sing-input confirm-password " required autocomplete="off" placeholder="Confirm Password">
                <input type="checkbox" name="check" id="check" class="check">
                <label for="check">Show Passwords</label>
            </div>
            <div class="input-fild submit">
                <button type="submit" name="submit" class="submit-button">Continue to chat</button>
                Already have an Account? <a href="main/singIn.php">Sing in</a>
            </div>
        </form>
    </div>
    <script src="javascript/value.js"></script>
    <script src="javascript/password.js"></script>
</body>

</html>