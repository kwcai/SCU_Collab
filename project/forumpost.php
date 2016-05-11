<?php

	 include('../svr_config.php');

	 	$user = $_POST['user']; // get from localstorage using ajax
	 	$title = $_POST['title'];
	 	$data = $_POST['data'];

	 	$group_name = "Test Page"; // would be given on group creation

	 	//retrieve ID of group
	 	$stmt = $db->prepare("SELECT group_id FROM groups WHERE group_name = ?");
		$stmt->bind_param('s', $group_name);
		$stmt->execute();
			
		$g_id = $stmt->get_result()->fetch_object()->group_id;

		echo $user;
		echo $title;
		echo $data;
		echo $g_id;

		$stmt->close();

	 	$stmt = $db->prepare("INSERT INTO posts (title, data, username, group_id) VALUES (?, ?, ?, ?)");

	 	$stmt->bind_param('sssi', $title, $data, $user, $g_id);

	 	$stmt->execute();

	 	$stmt->close();
	 	echo "Your post has been added";

	 	

?>