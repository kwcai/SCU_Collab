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
			if(empty($_POST["fname"]) || empty($_POST["lname"]) || empty($_POST["email"]) || empty($_POST["password"]))
			{
				$error = "Fields are required";
			} else
			{
				$fname = mysqli_real_escape_string($db, $_POST['fname']);
				$lname = mysqli_real_escape_string($db, $_POST['lname']);
				$email = mysqli_real_escape_string($db, $_POST['email']);
				$pass = mysqli_real_escape_string($db, $_POST['password']);
				$pass = md5($pass);

				$sql = "SELECT email FROM user_log WHERE email = '$email'";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				//Make sure all fields are filled


				if(mysqli_num_rows($result) == 1)
				{
				?>
					<script>alert('This email has already been used');</script>
				<?php
				}

				if(mysqli_query($db, "INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$pass')"))
				{
					header("Location: index.php");
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
		}
	?>

	<h2>Enter your information</h2>
	
	<div id="form">
		<form name = "reg" method = "post">
			<table style = "100%" align = "center">
				<tr>
					<td><input type="text" name="fname" placeholder="First Name"></td>
				</tr>
				<tr>
					<td><input type="text" name="lname" placeholder="Last Name"></td>
				</tr>
				<tr>
					<td><input type="text" name="email" placeholder="Email"></td>
				</tr>
				<tr>
					<td><input type="password" name = "password" placeholder = "Password"></td>
				</tr>
				<tr>
					<td><button type="submit" name="reg_button">Register</button></td>
				</tr>
			</table>
		</form>
	</div>
</body>