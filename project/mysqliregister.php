<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Register for SCUCollab</title>
	<link rel="stylesheet" href="styles.css" />
</head>

<body>

	<?php
		session_start();

		//check if there is active session or not

		if(isset($_SESSION['user'])!="")
		{
			header("Location: home.php");
		}
		include_once '../svr_config.php';

		if(isset($_POST['reg_button']))
		{
			$fname = mysqli_real_escape_string(trim($_POST['fname']));
			$lname = mysqli_real_escape_string(trim($_POST['lname']));
			$email = mysqli_real_escape_string(trim($_POST['email']));
			$pass = mysqli_real_escape_string(trim($_POST['pass']));

			if($MySQLi_CON->query("INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$password')"))
			{
			?>
				<script>alert('You have been successfully registered');</script>
			<?php
			}
			else
			{
			?>
				<script>alert('Registration error');</script>
			<?php
			}
		}
	?>

	<div id="form">
		<form name = "reg" method = "post">
			<input type = "text" name = "fname" placeholder = "First Name">
			<input type = "text" name = "lname" placeholder = "Last Name">
			<input type = "text" name = "email" placeholder = "Email">
			<input type = "password" name = "password" placeholder = "Password">
			<button type="submit" name="reg_button">Register</button>
		</form>
	</div>

	<a href="index.php"> Log In </a>

</body>