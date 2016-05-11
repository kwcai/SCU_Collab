<!--
Groups Table
	group_ID
	owner_ID
	group_name
	password
	description
-->


<?php

include('../svr_config.php');

// $search = $_GET["key"];

$query = "SELECT group_name FROM groups WHERE group_name = ?";

$query->bind_param("s", $search);

$array = array();

if ($stmt = $db->prepare($query))
{
    $stmt->execute();

    $stmt->bind_result($group_name);

    while ($stmt->fetch())
	{
		$array[] = $group_name;
        /*printf ("%s\n", $group_name);*/
    }

    $stmt->close();
}

echo json_encode($array);

?>