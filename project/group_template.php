<?php

	include "../../svr_config.php";

	// If statements to choose function

	/* Call when func is createpost */
	/*function createPost() {
		


	}*/

	if(isset($_GET['func'])
	{
		if($_GET['func'] == "time")
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

		if($result = $db->$query("SELECT * FROM posts WHERE group_id = $g_id ORDER by ID DESC LIMIT 10"))
		{

			echo "<table>";

			while ($row = $result->fetch_assoc())
			{
				echo "<tr><td>" . $row['title'] . "</tr></td>";
				echo "<tr><td>" . $row['data'] . "</tr></td>";
				echo "<tr><td>" . $row['username'] . "</tr></td>";
			}

			echo "<table>";

		}

		$result->free();

	}

	/* Call when param is events */
	function showEvents() {



	}

?>