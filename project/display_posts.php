<?php

	include('../svr_config.php');

	$user = $_POST['user'];
	//$user = "kcai";
	$p_id = array();
	$g_id = array();
	$groups = array();
	$titles = array();
	$data = array();

	/*$stmt = $db->prepare("SELECT group_id FROM usersTOgroups WHERE user_id = ?");
	$stmt->bind_param('s', $u_id);
	$stmt->execute();

	$g_id = $stmt->get_result()->fetch_object()->group_id;

	$stmt->close();*/

	/* Find the user's posts and their corresponding groups */
	$query = "SELECT `post_id`, group_id FROM posts WHERE username = '$user'";
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

	/*for($x = 0; $x < $p_arrlength; $x++) {
    	echo $p_id[$x];
    	echo "<br>";
    	echo $g_id[$x];
    	echo "<br>";
	} */


	/* Find the user's posts by their username */
	$in = join(',', array_fill(0, count($p_id), '?'));
	$select = "SELECT title, data FROM posts WHERE post_id IN ($in) ORDER BY post_id LIMIT 5";
	if($stmt = $db->prepare($select))
	{
		$stmt->bind_param(str_repeat('s', count($p_id)), ...$p_id);
		$stmt->execute();
	
		if($result = $stmt->get_result())
		{
			while($row = $result->fetch_assoc())
			{
				$titles[] = $row['title'];
				$data[] = $row['data'];
			}
		}
		$stmt->close();
	}

	$in1 = join(',', array_fill(0, count($g_id), '?'));
	$select = "SELECT group_name FROM groups WHERE group_id IN ($in1)";
	if($stmt = $db->prepare($select))
	{
		$stmt->bind_param(str_repeat('s', count($g_id)), ...$g_id);
		$stmt->execute();
	
		if($result = $stmt->get_result())
		{
			while($row = $result->fetch_assoc())
			{
				$groups[] = $row['group_name'];
			}
		}
		$stmt->close();
	}

	for($x = 0; $x < $p_arrlength; $x++) {
		echo "<div class=\"box\">";
		echo "<h2 class=\"posttitle\">" . $titles[$x] . "</h2>";
		echo "<p class=\"postdescription\">" . $data[$x] . "</p>";
		echo "<p class=\"postdescription\"> - Posted in: " . $groups[$x] . "</p>";
    	echo "</div>";
	} 

	/*$in = join(',', array_fill(0, count($p_id), '?'));
	$select = "SELECT group_name FROM groups WHERE group_id IN ($in)";
	if($stmt = $db->prepare($select))
	{
		$stmt->bind_param(str_repeat('s', count($id_groups)), ...$id_groups);
		$stmt->execute();
	
		if($result = $stmt->get_result())
		{
			while($row = $result->fetch_assoc())
			{
				/*$string = $row['group_name'];
				$string = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
				$string = preg_replace('!\s+!', '', $string);
				echo "<li><a href=\"groups/" . $string . ".html\">" . $row['group_name'] . "</a></li>";
				$
			}
		}
		$stmt->close();
	}*/

?>
