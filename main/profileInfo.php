<?php
include "../connection.php";
if (isset($_POST['submit_info'])) {
    $account_id = $_POST['account_id'];
    $edit_type = $_POST['edit_type'];
    $home_town = $_POST['home'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $work = $_POST['work'];
    $companey = $_POST['companey'];
    $cirtificate = $_POST['cirtificate'];
    $institute = $_POST['institute'];
    $relationshio = $_POST['relationship'];
}
if ($edit_type == "ADD") {
    $sqli1 = mysqli_query($conn, "INSERT INTO `account_info`(	`account_num`,`home_town`,`city`,`country`,`work`,`company`,	`cirtificate`,`institute`,`relationship`)VALUES('{$account_id}','{$home_town}','{$city}','{$country}','{$work}','{$companey}','{$cirtificate}','{$institute}','{$relationshio}')	
");
    if ($sqli1) {
        $succ = "ok";
    }
}
if ($edit_type == "EDIT") {
    $sqli2 = mysqli_query($conn, "UPDATE account_info SET `home_town`='{$home_town}',`city`='{$city}',`country`='{$country}',`work`='{$work}',`company`='{$companey}',`cirtificate`='{$cirtificate}',`institute`='{$institute}',`relationship`='{$relationshio}' WHERE account_num ='{$account_id}'");
    if ($sqli2) {
        $succ = "ok";
    }
}
if ($succ != "" && $succ == "ok") {
    header("Location:profiles.php?ids=$account_id");
}
