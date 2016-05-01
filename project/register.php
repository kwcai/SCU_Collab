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
			$fname = mysqli_real_escape_string($db, $_POST['fname']);
			$lname = mysqli_real_escape_string($db, $_POST['lname']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$pass = mysqli_real_escape_string($db, $_POST['password']);
			$pass = md5($password);

			$sql = "SELECT email FROM user_log WHERE email = '$email'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC)

			if(mysqli_num_rows($result) == 1)
			{
			?>
				<script>alert('This email has already been used');</script>email
			<?php
			}

			if(mysqli_query($db, "INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$password')"))
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