<?php

		include '../svr_config.php';

		if($_POST)
		{
			$fname = mysqli_real_escape_string($db, $_POST['f_name']);
			$lname = mysqli_real_escape_string($db, $_POST['l_name']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$pass = mysqli_real_escape_string($db, $_POST['password']);
			$pass = md5($pass);

			$sql = "SELECT email FROM user_log WHERE email = '$email'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			//Make sure all fields are filled


			if(mysqli_num_rows($result) == 1)
			{
				echo "exist";
			}
			else
			{
				$entry = mysqli_query($db, "INSERT INTO user_log(name_first, name_last, email, password) VALUES ('$fname', '$lname', '$email', '$pass')");

				if($entry)
				{
					echo "success";
				}
			
				else
				{
					echo "failed";
				}
			}
		
		echo mysqli_error($db);
		}
	?>
