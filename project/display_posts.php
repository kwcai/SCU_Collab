<?php

	include('../svr_config.php');

	echo "here we go";

	$user = $_POST['user'];
	//$user = "kcai";
	$p_id = array();
	$g_id = array();
	$groups = array();
	$titles = array();
	$data = array();

	/* Find the user's ID */
	$stmt = $db->prepare("SELECT user_id FROM users WHERE username = ?");
	$stmt->bind_param('s', $user);
	$stmt->execute();
			
	$u_id = $stmt->get_result()->fetch_object()->user_id;

	$stmt->close();

	/*$stmt = $db->prepare("SELECT group_id FROM usersTOgroups WHERE user_id = ?");
	$stmt->bind_param('s', $u_id);
	$stmt->execute();

	$g_id = $stmt->get_result()->fetch_object()->group_id;

	$stmt->close();*/

	/* Find the user's posts and their corresponding groups */
	$query = "SELECT post_id, group_id FROM posts WHERE user_id = '$u_id'";
	if($result = $db->query($query))
	{
		while($row = $result->fetch_assoc())
		{
			$p_id[] = $row['post_id'];
			$g_id[] = $row['group_id'];
		}
	}

	$p_arrlength = count($p_id);
	$g_arrlength = count($g_id);

	for($x = 0; $x < $arrlength; $x++) {
    	echo $p_id[$x];
    	echo $g_id[$x];
    	echo "<br>";
	} 

	/*$in = join(',', array_fill(0, count($g_id), '?'));
	$select = "SELECT group_name FROM groups WHERE group_id IN ($in)";
	if($stmt = $db->prepare($select))
	{
		$stmt->bind_param(str_repeat('s', count($id_groups)), ...$id_groups);
		$stmt->execute();
	
		if($result = $stmt->get_result())
		{
			while($row = $result->fetch_assoc())
			{
				$string = $row['group_name'];
				$string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
				$string = preg_replace('!\s+!', '', $string);
				echo "<li><a href=\"groups/" . $string . ".html\">" . $row['group_name'] . "</a></li>";
				$
			}
		}
		$stmt->close();
	}*/

?>
