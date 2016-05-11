<?php

	include('../svr_config.php');

	$user = $_POST['user'];
	//$user = "kcai";
	$id_groups = array();
	$group_names = array();

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

	$query = "SELECT group_id FROM usersTOgroups WHERE user_id = '$u_id'";
	if($result = $db->query($query))
	{
		while($row = $result->fetch_assoc())
		{
			$id_groups[] = $row['group_id'];
		}
	}

	$arrlength = count($id_groups);

	/*for($x = 0; $x < $arrlength; $x++) {
    	echo $id_groups[$x];
    	echo "<br>";
	} */

	$in = join(',', array_fill(0, count($id_groups), '?'));
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
			}
		}
		$stmt->close();
	}

?>
