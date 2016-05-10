<?php
	
 include('../svr_config.php');

		$g_name = $_POST['g_name'];
		$description = $_POST['description'];

		$user = $_POST['user'];

		$pass = $_POST['password'];
		$pass = md5($pass);

        /* Check if group name has already been used */
        $stmt1 = $db->prepare("SELECT group_id FROM groups WHERE group_name = ?");
        $stmt1->bind_param("s", $g_name);
        if($stmt1->execute() == false)
		{
			echo "Failed: " . $db->error;
		}
        $result = $stmt1->fetch();
		$stmt1->close();

		if(!empty($result))
		{
          echo "This Group Name has already been taken";
		}
		else
        {
        	/* If it has not, insert new entry into 'groups' */
        	$stmt2 = $db->prepare("INSERT INTO `groups` (`group_name`, `owner_id`, `password`, `description`) VALUES (?, ?, ?, ?)");

			if(!$stmt2) {
				printf('errno: %d, error: %s', $db->errno, $db->error);
				die;
			}

			/* Retrieve user id of student creating the group */
			$stmt3 = $db->prepare("SELECT user_id FROM users WHERE username = ?");
			$stmt3->bind_param('s', $user);
			$stmt3->execute();
			
			$u_id = $stmt3->get_result()->fetch_object()->user_id;

			$stmt3->close();

			$stmt2->bind_param('siss', $g_name, $u_id, $pass, $description);
        	
        	if($stmt2->execute() == false)
			{
				echo "Problem creating group";
			}
		    else
		    {
				printf("%d Row inserted.\n", $stmt2->affected_rows);

				/* If the group is successfully created, add relationship for creator and group */
				$g_id = $db->insert_id;

				echo "$g_id";

				$stmt2->close();

				$stmt = $db->prepare("INSERT INTO `usersTOgroups` (`user_id`, `group_id`) VALUES (?, ?)");
				if(!$stmt) {
					printf('errno: %d, error: %s', $db->errno, $db->error);
					die;
				}
				$stmt->bind_param('ii', $u_id, $g_id);
				$stmt->execute();

				/* Following code uses template files to create pages/files for the new group */

				$tpl_file = "group_template.html";
				$tpl_path = "templates/";
				$group_path = "groups/";

				$data = array(
           		'g_name' => '',
          		'description' => ''
          		);

          		$data['g_name'] = preg_replace('!\s+!', ' ', $_POST["g_name"]);
           		$data['description'] = $_POST["description"];

          	  	$tpl = file_get_contents($tpl_path.$tpl_file);

	          	$placeholders = array("{group_name}", "{description}");

	         	$new_groupfile = str_replace($placeholders, $data, $tpl);

				$string = $data['g_name'];
				$string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
				$string = str_replace(' ', '', $string);

				$file = $string.".html";

				file_put_contents($group_path.$file, $new_groupfile);
				echo $file;
			}
				//else
        }
?>
