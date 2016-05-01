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
		include_once 'svr_config.php';

		if(isset($_POST['reg_button']))
		{
			$fname = mysql_real_escape_string($_POST['fname']);
			$lname = mysql_real_escape_string($_POST['lname']);
			$email = mysql_real_escape_string($_POST['email']);
			$pass = mysql_real_escape_string($_POST['pass']);

			if(mysql_query("INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$password')"))
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
			<button type="submit" name="btn-reg">Register</button>
		</form>
	</div>

	<a href="index.php"> Log In </a>

</body>


