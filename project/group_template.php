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
    $group_page = "{group_name}";
    
    $stmt = $db->query("SELECT `group_id` FROM `groups` WHERE group_name = '$group_page'"); //would replace in template
    $row = $stmt->fetch_assoc();
    $g_id = $row['group_id'];
    
    //echo $g_id;

		if($result = $db->query("SELECT * FROM `posts` WHERE group_id = '$g_id' ORDER by `post_id` LIMIT 10"))
		{

			//echo "<table>";

			while ($row = $result->fetch_assoc())
			{
				echo "<div class=\"box\">";
				echo "<h2 class=\"posttitle\">" . $row['title'] . "</h2>";
				echo "<p class=\"postdescription\">" . $row['data'] . "</p>";
				//echo "<tr><td>" . $row['title'] . "</h2>";
				//echo "<tr><td>" . $row['data'] . "</p>";
				echo "<tr><td>Posted by: " . $row['username'] . "</tr></td>";
				echo "</div>";
			}

			//echo "<table>";
      
      		$result->free();

		}
    else
      die($db->error);

	}

	/* Call when param is events */
	function showEvents() {



	}

?>