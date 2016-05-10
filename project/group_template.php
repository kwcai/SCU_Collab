<?php

	include('../../svr_config.php');

	// If statements to choose function

	/* Call when func is createpost */
	/*function createPost() {
		


	}*/

	if(isset($_GET['function']))
	{
		if($_GET['function'] == "posts")
		{
			showPosts();
		}
		else
		{
			showEvents();
		}
	}

	/* Call when param is forum */
	function showPosts() {
 
    global $db;
    $group_page = "Test Page"; // replace as well
    
    $stmt = $db->query("SELECT `group_id` FROM `groups` WHERE group_name = '$group_page'"); //would replace in template
    $row = $stmt->fetch_assoc();
    $g_id = $row['group_id'];
    
    echo $g_id;

		if($result = $db->query("SELECT * FROM `posts` WHERE group_id = '$g_id' ORDER by `post_id` DESC LIMIT 10"))
		{

			echo "<table>";

			while ($row = $result->fetch_assoc())
			{
				echo "<tr><td>" . $row['title'] . "</tr></td>";
				echo "<tr><td>" . $row['data'] . "</tr></td>";
				echo "<tr><td>" . $row['username'] . "</tr></td>";
			}

			echo "<table>";
      
      		$result->free();

		}
    else
      die($db->error);

	}

	/* Call when param is events */
	function showEvents() {



	}

?>