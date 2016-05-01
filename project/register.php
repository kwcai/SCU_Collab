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
			$fname = mysqli_real_escape_string($_POST['fname']);
			$lname = mysqli_real_escape_string($_POST['lname']);
			$email = mysqli_real_escape_string($_POST['email']);
			$pass = mysqli_real_escape_string($_POST['password']);

			if(mysqli_query("INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$password')"))
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
			<table style = "50%">
				<tr>
					<td><input type = "text" name = "fname" placeholder = "First Name"></td>
				</tr>
				<tr>
					<td><input type = "text" name = "lname" placeholder = "Last Name"></td>
				</tr>
				<tr>
					<td><input type = "text" name = "email" placeholder = "Email"></td>
				</tr>
				<tr>
					<td><input type = "password" name = "password" placeholder = "Password"></td>
				</tr>
				<tr>
					<button type="submit" name="reg_button">Register</button>
				</tr>
			</table>
		</form>
	</div>
</body>