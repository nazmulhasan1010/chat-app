<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Message Bee</title>
	<script src="https://kit.fontawesome.com/a81e295c63.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../style/main.css?v=<?php echo time(); ?>" />
	<script src="../javascript/jquery-3.5.1.min.js"></script>
</head>

<body>
	<?php
	header('Access-Control-Allow-Origin: *');
	?>
	<?php
	include "../connection.php";
	session_start();
	$account_id = $_SESSION['accountId'];
	$statuses = "";
	if ($account_id) {
		$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$account_id}'");
		$row = mysqli_fetch_assoc($sql);
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$status = $row['status'];
		$profile_pic = $row['profile_pic'];
	}

	?>
	<div class="main-stracture">
		<div class="main-header">
			<div class="profile-review profile-preview2">
				<div class="profile-picturen"><a class="profile_link" href="profiles.php?ids=<?php echo $account_id; ?>"><img class="profile-pic" src="<?php echo $profile_pic; ?>" alt="" /></a></div>
				<div class="name-status">
					<a class="profile_link" href="profiles.php?ids=<?php echo $account_id; ?>">
						<div class="name-modal"><?php echo "$first_name $last_name"; ?></div>
						<div class="status"><?php echo $status; ?></div>
					</a>
				</div>

			</div>
			<div class="menu-bar menu2">
				<button type="button" class="search-button"><i class="fas fa-search"></i></button>
				<button type="button" class="cross-button"><i class="fas fa-times"></i></button>
			</div>
			<div class="menu-bar menu2 menuf"><i class="fas fa-bars"></i></div>
		</div>
		<div class="side-navigation side-navigationss" id="navigation">
			<div class="menuess">
				<div class="menues">
					<a class="menues-item" href="homePage.php">Home</a>
				</div>
				<div class="menues add-contracts-option">
					Add a contract
				</div>
				<div class="menues">
					<a class="menues-item" href="temp.php">Request</a>
				</div>
				<!-- <div class="menues">
					<a class="menues-item" href="">Settings</a>
				</div>
				<div class="menues">
					<a class="menues-item" href="">Privacy</a>
				</div> -->
				<div class="menues logOut">
					<a class="menues-item" href="singIn.php">Log out</a>
				</div>
			</div>
		</div>
		<div class="contract-field fild" id="chat-fild">
			<div class="active-search">
				<div class="search-bar-text" id="search-bar-text">
					<form action="" class="search-form" method="post">
						<div class="serch_field">
							<input type="text" class="search-contract-input" name="search-text" required autocomplete="off" />
						</div>
					</form>
					<div class="search_result">

					</div>
				</div>
				<div class="active-contracts-area">
					<div class="activet-contracts">

					</div>
					<div class="search-bar">

					</div>
				</div>
			</div>
			<div class="contracts contractssess">

			</div>
			<input type="hidden" name="hidden" class="hidden_account" value="<?php echo $account_id; ?>">

		</div>
		<div class="contract-field fild active_fild" id="active-fild">

		</div>

		<div class="add-contracts-modal" id="addds">
			<div class="cancen-btn-add"><i class="fas fa-times"></i></div>
			<p class="hedar-txts">Add a contract by Email.</p>
			<form action="" method="post">
				<input class="add-input" type="text" name="add-email" value="" placeholder="Enter a email.." require>
				<button class="add-buttone" name="add-buttone" type="submit">Add</button>
			</form>
		</div>
		<div class="add-contracts-modals addcontractsmodals">
			<div class="optionses optionses1">
				Delete conversation
			</div>
			<div class="optionses optionses2">
				<a href="" class="view_profile_link linkAddress">View profile </a>
			</div>
			<!-- <div class=" optionses optionses3">
				Remove contract
			</div> -->
		</div>
		<div class="add_contrac">
			<div class="cancen-btn-add cancen-btn-add2"><i class="fas fa-times"></i></div>
			<p class="hedar-txts">Add a contract by Email.</p>
			<form action="" method="post">
				<input class="add-input" type="text" name="add-email" value="" placeholder="Enter a email.." require>
				<button class="add-buttone" name="add-buttone" type="submit">Add</button>
			</form>
		</div>
		<div class="text-area text-area2">
			<div class="contracts2">
				<button id="chat-buttons" class="footer-menu-button">
					<i class="fas fa-comment-alt"></i>
					<div style="font-size:15px; font-weight:bold; margin:-5px 0 0 0">
						chat
					</div>
				</button>
			</div>
			<div class="active-contracts">
				<button id="activw-buttons" class="footer-menu-button">
					<i class="fas fa-user-friends"></i>
					<div style="font-size:15px; font-weight:bold; margin:-5px 0 0 0">
						active
				</button>
			</div>
		</div>
	</div>
	<?php
	if (isset($_POST['add-buttone'])) {
		$contract_email = $_POST['add-email'];
		if ($contract_email !== "") {
			$sql5 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$contract_email}'");
			if ($sql5) {
				if (mysqli_num_rows($sql5) > 0) {
					$contractss = mysqli_fetch_assoc($sql5);
					$contract_number = $contractss['unique_id'];
					$sql7 = mysqli_query($conn, "SELECT *FROM `" . $account_id . "` WHERE contracts ='{$contract_number}'");
					if (mysqli_num_rows($sql7) == 0) {
						$sqli1 = mysqli_query($conn, "INSERT INTO `$contract_number`(contracts,relation)VALUES('{$account_id}','temp')");
						if ($sqli1) {
							$sql6 = mysqli_query($conn, "INSERT INTO `$account_id` (contracts,relation) VALUE ('{$contract_number}','waiting')");
							if ($sql6) {
								$statuses = "Added";
							}
						} else {
							$status = "Something is wrong";
						}
					} else {
						$statuses = "The contract already added";
					}
				} else {
					$statuses = "No contracts found!";
				}
			}
		}
	}
	?>
	<?php
	if ($statuses !== "") {
	?>
		<div class="status-bars" id="snackbar">
			<?php echo $statuses; ?>
		</div>
	<?php
	}
	?>
	<script src="../javascript/main.js"></script>
	<script src="../javascript/users.js"></script>
</body>

</html>