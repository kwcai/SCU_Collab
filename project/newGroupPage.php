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

				/* If the group is successfully created, add relationship for creator and group 
				   Also add the relationship for posts and group */
				$g_id = $db->insert_id;

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
				$tpl_js_file = "group_template.js";
				$tpl_php_file = "group_template.php";
				$tpl_post_file = "post_template.html";
				$tpl_post_js_file = "post_template.js";
				$tpl_post_php_file = "post_template.php";

				$tpl_path = "templates/";
				$group_path = "groups/";

				$data = array(
           		'g_name' => '',
          		'description' => '',
          		'glink' => ''
          		);

          		$data['g_name'] = preg_replace('!\s+!', ' ', $_POST["g_name"]);
           		$data['description'] = $_POST["description"];
           		$data['glink'] = preg_replace('!\s+!', '', $_POST["g_name"]);

           		/* place files for main page */
          	  	$tpl = file_get_contents($tpl_path.$tpl_file);
          	  	$tpl_js = file_get_contents($tpl_path.$tpl_js_file);
          	  	$tpl_php = file_get_contents($tpl_path.$tpl_php_file);

          	  	/* place files for post page */
          	  	$tpl_post = file_get_contents($tpl_path.$tpl_post_file);
          	  	$tpl_post_js = file_get_contents($tpl_path.$tpl_post_js_file);
          	  	$tpl_post_php = file_get_contents($tpl_path.$tpl_post_php_file);

	          	$placeholders = array("{group_name}", "{description}", "{group_link}");

	         	$new_groupfile = str_replace($placeholders, $data, $tpl);
	         	$new_groupjs = str_replace($placeholders, $data, $tpl_js);
	         	$new_groupphp = str_replace($placeholders, $data, $tpl_php);
	         	$new_postfile = str_replace($placeholders, $data, $tpl_post);
	         	$new_postjs = str_replace($placeholders, $data, $tpl_post_js);
	         	$new_postphp = str_replace($placeholders, $data, $tpl_post_php);

				$string = $data['g_name'];
				$string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
				$string = str_replace(' ', '', $string);

				$file = $string.".html";
				$file_js = $string.".js";
				$file_php = $string.".php";
				$file_post = $string."post.html";
				$file_post_js = $string."post.js";
				$file_post_php = $string."post.php";

				file_put_contents($group_path.$file, $new_groupfile);
				file_put_contents($group_path.$file_js, $new_groupjs);
				file_put_contents($group_path.$file_php, $new_groupphp);
				file_put_contents($group_path.$file_post, $new_postfile);
				file_put_contents($group_path.$file_post_js, $new_postjs);
				file_put_contents($group_path.$file_post_php, $new_postphp);

				echo $file;
			}
				//else
        }
?>
