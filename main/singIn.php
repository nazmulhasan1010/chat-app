<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Message Bee sing in</title>
    <script src="https://kit.fontawesome.com/a81e295c63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/singUp.css?<?php echo time(); ?>">
</head>

<body>
    <?php
    include "../connection.php";
    $error = $success = "";
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($email) {
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $main_password = $row['password'];
                $user_password = md5($password);
                $account_id = $row['unique_id'];
                if ($user_password == $main_password) {
                    $status = "Active now";
                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$account_id}'");
                    if ($sql2) {
                        session_start();
                        $_SESSION['accountId'] = "$account_id";
                        header("Location: homePage.php");
                    } else {
                        $error = "Somthing was wrong";
                    }
                } elseif ($password == $main_password) {
                    $status = "Active now";
                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$account_id}'");
                    if ($sql2) {
                        session_start();
                        $_SESSION['accountId'] = "$account_id";
                        header("Location: homePage.php");
                    } else {
                        $error = "Somthing was wrong";
                    }
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "No account found on this email. Please create an account.";
            }
        }
    }
    ?>
    <div class="main-form">
        <div class="header">
            <div class="header-text">
                Message Bee Sign In
            </div>
        </div>
        <?php
        if ($error !== "") {
        ?>
            <div class="error-box">
                <?php echo $error; ?>
            </div>
        <?php
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

            <div class="input-fild">
                <label for="email">Email Address</label>
                <input type="text" name="email" class="sing-input email" required autocomplete="off" placeholder="Email Address">
            </div>
            <div class="input-fild">
                <label for="passwoord"> Password</label>
                <div class="password_fild">
                    <input type="password" name="password" class="sing-input password passwordrs" required autocomplete="off" placeholder="Password">
                    <div class="hide_pass">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>
            </div>
            <div class="input-fild submit">
                <button type="submit" name="submit" class="submit-button">Continue to chat</button>
                Don't have Account? <a href="../index.php">Sing Up</a>
            </div>

        </form>
    </div>
    <script src="../javascript/singinpass.js"></script>
</body>

</html>