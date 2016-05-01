<!DOCTYPE html>
<body>
	<?php
		session_start();
		include_once '../svr_config.php';
		
		if(isset($_SESSION['user'])!="")
		{
			header("Location: home.php");
		}
		
		if(isset($_POST['myLoginButton']))
		{
			$email = mysqli_real_escape_string($_POST['email']);
			$pass = mysqli_real_escape_string($_POST['pass']);
			$res = mysqli_query("SELECT * FROM users WHERE email='$email'");
			$row = mysqli_fetch_array($res);
			
			if($row['password']==md5($pass))
			{
				$_SESSION['user'] = $row['user_id'];
				header("Location: home.php");
			}
			else
			{
				?>
				<script>alert('Incorrect login');</script>
				<?php
			}
		}
	?>
</body>

<html lang="en">
	<head>
		<title>Login Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>SCU Collab</h1>
		
		<div class = "input">
			<input type="text" id="username" name="email" placeholder="email">
		</div>
		
		<div class = "input">
			<input type="password" id="password" name="pwd" placeholder="password">
		</div>
		
		<div class = "login">
			<input type="submit" button id = "loginButton" name="myLoginButton">Login</button>
		</div>
		
		<div class = "register">
			<a href = "register.php">Sign Up</a>
		</div>
		
	</body>
</html>