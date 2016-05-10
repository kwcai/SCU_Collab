<?php

	include "../../svr_config.php";

	// If statements to choose function

	/* Call when func is createpost */
	function createPost() {
		


	}

	/* Call when param is forum */
	function showPosts() {

		if($result = $db->$query("SELECT * FROM posts WHERE group_id = $u_id ORDER by ID DESC LIMIT 10"))
		{
			while ($row = $result->fetch_assoc())
			{

			}
		}

		$result->free();

	}

	/* Call when param is events */
	function showEvents() {



	}

?>