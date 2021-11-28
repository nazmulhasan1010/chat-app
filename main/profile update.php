<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Message bee </title>
    <link rel="stylesheet" href="../style/profile.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    $error = "";
    include "../connection.php";
    session_start();
    if (isset($_SESSION['account_uni_id'])) {
        $account_uni_id = $_SESSION['account_uni_id'];
    }
    if ($account_uni_id) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$account_uni_id}'");
        $account_info = mysqli_fetch_assoc($sql);
        $first_name = $account_info['first_name'];
        $last_name = $account_info['last_name'];
    }
    if (isset($_POST['submit-button'])) {
        $file_name = $_FILES['picture']['name'];
        $temp_name = $_FILES['picture']['tmp_name'];
        $file_size = $_FILES['picture']['size'];
        $file_type = $_FILES['picture']['type'];

        $folder = "../img/profiles/";
        $file_name_comp = time() . '.jpg';
        $folderCon = $folder . $file_name_comp;

        if ($file_size <= 5000000) {
            $sql2 = mysqli_query($conn, "UPDATE users SET profile_pic = '{$folderCon}' WHERE unique_id = '{$account_uni_id}'");
            if ($sql2) {
                move_uploaded_file($temp_name, $folderCon);
                $_SESSION['accountId'] = "$account_uni_id";
                header('Location: homePage.php');
            } else {
                $error = "Somthing was wrong!";
            }
        } else {
            $error = "The file size is over to maximum size.";
        }
    }
    if (isset($_POST['skip_button'])) {
        $folderCon = "../img/profile.png";
        $sql3 = mysqli_query($conn, "UPDATE users SET profile_pic = '{$folderCon}' WHERE unique_id = '{$account_uni_id}'");
        if ($sql3) {
            $_SESSION['accountId'] = "$account_uni_id";
            header('Location: homePage.php');
        }
    }
    ?>
    <div class="profile-update">
        <form action="" method="post">
            <button type="submit" name="skip_button" class="skip_button">Skip</button>
        </form>
        <div class="text-box">
            <p class="head-text">
                Upload your profile picture.
            </p>
            <p class="requirment">
                Note: supported formate (jpeg, .png, .gif, .ico) and maximum size 2 MB (mega byte).
            </p>
        </div>
        <?php
        if ($error !== "") {
        ?>
            <div class="error-box">
                <?php
                echo $error;
                ?>
            </div>
        <?php
        }
        ?>
        <div class="picture-previews">
            <img alt="" src="../img/profile.png" id="picture-preview">
        </div>
        <p class="profile-name"><?php echo "$first_name $last_name"; ?></p>
        <form action="" method="post" enctype="multipart/form-data" class="file-update">
            <div class="chose-file">
                <label for="file-update" class="label-as" id="label-as">Chose a file...</label>
                <input type="file" name="picture" accept=".jpeg, .png, .gif, .ico" id="file-update" required hidden>
            </div>
            <button type="submit" class="submit-button" name="submit-button" id="submit-button">Continue..</button>
        </form>
    </div>
    <script>
        const inFileProf = document.getElementById('file-update');
        const preViewImgProf = document.getElementById('picture-preview');
        const btnShow = document.getElementById('submit-button');
        const labelHide = document.getElementById('label-as');
        inFileProf.addEventListener('change', function() {
            const fileProf = this.files[0];
            if (fileProf) {
                const reader = new FileReader();
                btnShow.style.display = 'block';
                labelHide.style.display = 'none';
                reader.addEventListener('load', function() {
                    console.log(this);
                    preViewImgProf.setAttribute('src', this.result);
                });
                reader.readAsDataURL(fileProf);
            }
        });
    </script>
    <script src="../javascript/jquery-3.5.1.min.js"></script>
</body>

</html>