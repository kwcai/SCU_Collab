<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	
	<body>
		<?php
			session_start();
			
			if(isset($_SESSION['user'])!="")
			{
				header("Location: home.php");
			}
			
			include_once '../svr_config.php';
			
			if(isset($_POST['myLoginButton']))
			{
				echo 'ok';
				$email = mysqli_real_escape_string($db, $_POST['email']);
				$pass = mysqli_real_escape_string($db, $_POST['pass']);

				$result = mysqli_query($db, "SELECT * FROM user_log WHERE email='$email'");
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				
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
		<h1>SCU Collab</h1>
		<form name="log" method="post">
			<div class = "input">
				<input type="text" name="email" placeholder="email">
			</div>
			
			<div class = "input">
				<input type="password" name="pass" placeholder="password">
			</div>
			
			<div class = "login">
				<button type="submit" name="myLoginButton">Login</button>
			</div>
			
			<div class = "register">
				<a href = "register.php">Sign Up</a>
			</div>
		</form>
	</body>
</html>