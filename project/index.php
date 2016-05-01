<body>
	<?php
		session_start();
		include_once '[filename].php';
		
		if(isset($_SESSION['user'])!="")
		{
			header("Location: home.php");
		}
		if(isset($_POST['btn-login']))
		{
			$email = mysql_real_escape_string($_POST['email']);
			$pass = mysql_real_escape_string($_POST['pass']);
			$res=mysql_query("SELECT * FROM users WHERE email='$email'");
			$row=mysql_fetch_array($res);
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
			<input type = "text" name = "email" placeholder = "Email">
			<input type = "text" name = "password" placeholder = "Password">
		</form>
	</div>
	
</body>
