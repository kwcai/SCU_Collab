<?php
	
 include('../svr_config.php');

				$g_name = $_POST['g_name'];
				$description = $_POST['description'];

				$user = $_POST['user'];

				$pass = $_POST['password'];
				$pass = md5($pass);

				/*$sql = "SELECT group_id FROM groups WHERE group_name = $g_name";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);*/

        
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
        	$stmt2 = $db->prepare("INSERT INTO `groups` (`group_name`, `owner_id`, `password`, `description`) VALUES (?, ?, ?, ?)");

			if(!$stmt2) {
				printf('errno: %d, error: %s', $db->errno, $db->error);
				die;
			}

			$stmt3 = $db->prepare("SELECT user_id FROM users WHERE username = ?");
			$stmt3->bind_param('s', $user);
			$stmt3->execute();
			
			$u_id = $stmt3->get_result()->fetch_object()->user_id;
			echo $u_id;


			$stmt2->bind_param('siss', $g_name, $u_id, $pass, $description);
        	if($stmt2->execute() == false)
			{
				echo "Insert failed: " . $db->error;
			}
		    else
				printf("%d Row inserted.\n", $stmt2->affected_rows);

          //mysqli_query($db, "INSERT INTO usersTOgroups (user_id, group_id) VALUES ($u_id, SELECT group_id FROM groups WHERE group_name = $g_name)");
          	/*$tpl_file = "group_template.html";
	          $tpl_path = "templates/";
          	$group_path = "groups/";

          	$data = array(
           		'g_name' => '',
          		'description' => ''
          		);

          	$data['g_name'] = $_POST["g_name"];
           	$data['description'] = $_POST["description"];

          	$tpl = file_get_contents($tpl_path.$tpl_file);

	          $placeholders = array("{group_name}", "{description}");

	          $new_groupfile = str_replace($placeholders, $data, $tpl);

	          $string = $data['g_name'];
	          $string = str_replace(' ', '', $string);

	          $file = $string.".html";

	          file_put_contents($group_path.$file, $new_groupfile);
	          echo $file;
				}
				//else
				{
				  echo "There seems to be a problem";
				}*/
        }
?>
