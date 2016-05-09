<?php
	
	include '../svr_config.php';
	
	if($_POST)
	{
		
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$pass = mysqli_real_escape_string($db, $_POST['password']);

		$result = mysqli_query($db, "SELECT * FROM user_log WHERE email='$email'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if($row['password']==md5($pass))
		{
			//$_SESSION['user'] = $row['email'];
			//$_SESSION['user'] = $email;
			echo "success";
		}
		else
		{
			echo "failure";
		}
	}
?>
