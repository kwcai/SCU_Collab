<body>
	<?php
		session_start();
		include_once 'databaseconnect.php';
		
		if(isset($_SESSION['user'])!="")
		{
			header("Location: home.php");
		}
		
		if(isset($_POST['btn-login']))
		{
			$email = $MySQLi_CON->real_escape_string($_POST['email']);
			$pass = $MySQLi_CON->real_escape_string($_POST['pass']);
			$res = $MySQLi_CON->query("SELECT * FROM users WHERE email='$email'");
			$row = $MySQLi_CON->fetch_array($res);
			if($row['password']==md5($pass))
			{
				$_SESSION['user'] = $row['user_id'];
				header("Location: home.php");
			}
			else
			{
				?>
				<script>alert('wrong details');</script>
				<?php
			}
		}
	?>

	<div id="form">
		<form name = "ind" method = "post">
			<input type = "text" name = "email" placeholder = "email">
			<input type = "text" name = "password" placeholder = "password">
		</form>
	</div>	
</body>



<!--qnimate.com/creating-a-sidebar-menu/-->
<?php
	include("svr_config.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST")
?>

<!DOCTYPE html>
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
			<input type="text" id="password" name="pwd" placeholder="password">
		</div>
		
		<div class = "login">
			<button id = "loginButton" onclick = "login()">Login</button>
		</div>
		
		<div class = "register">
			<a href = "register.php">Sign Up</a>
		</div>
		
	</body>
</html>