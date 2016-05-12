<?php
	
 include('../svr_config.php');

		$g_name = $_POST['g_name'];

		echo $g_name;

		$user = $_POST['user'];

		$pass = $_POST['grouppassword'];
		$pass = md5($pass);

		/* Check if group exists */
        $stmt = $db->prepare("SELECT group_id FROM groups WHERE group_name = ?");
        $stmt->bind_param("s", $g_name);
        if($stmt->execute() == false)
		{
			echo "Failed: " . $db->error;
		}
		$stmt->bind_result($g_id);
        $result = $stmt->fetch();
        //$g_id = $stmt->get_result()->fetch_object()->group_id;
        //echo $g_id;
		$stmt->close();

		if(empty($result))
		{
          exit("This group does not exist");
		}
		else
		{
	        /* Retrieve user id */
	        $stmt = $db->prepare("SELECT user_id FROM users WHERE username = ?");
	        $stmt->bind_param("s", $user);
	        if($stmt->execute() == false)
			{
				echo "Failed: " . $db->error;
			}
	        //$result = $stmt->fetch();
	        $u_id = $stmt->get_result()->fetch_object()->user_id;
	        echo $u_id;
			$stmt->close();

			/* Check if the user is already in the group */
			$stmt = $db->prepare("SELECT u2g_id FROM usersTOgroups WHERE user_id = ? AND group_id = ?");
			$stmt->bind_param("ii", $u_id, $g_id);
			if($stmt->execute() == false)
			{
				echo "Failed: " . $db->error;
			}
        	$result = $stmt->fetch();
        
			$stmt->close();

			if(!empty($result))
			{
				exit("You are already in this group");
			}
			else
			{
				$stmt = $db->prepare("INSERT INTO usersTOgroups (user_id, group_id) VALUES (?, ?)");
				$stmt->bind_param("ii", $u_id, $g_id);
				$stmt->execute();

				$string = preg_replace('!\s+!', '', $g_name);
				$string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
				echo $string;
			}
		}
?>