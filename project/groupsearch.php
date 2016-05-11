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

$search = $_GET["key"];

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

/*while($row = mysql_fetch_assoc($query))
{
	$array[] = $row['group_name'];
}*/

/*

if (strlen($query) > 0)
{	
	$hint = "";
	for($i=0; $i<($x->length); $i++)
	{
		$y = $x->item($i)->getElementsByTagName('title');
		$z = $x->item($i)->getElementsByTagName('url');
		if ($y->item(0)->nodeType == 1)
		{
		//find a link matching the search text
			if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
			{
				if ($hint == "")
				{
					$hint="<a href='" . 
					$z->item(0)->childNodes->item(0)->nodeValue . 
					"' target='_blank'>" . 
					$y->item(0)->childNodes->item(0)->nodeValue . "</a>";
				}
				else
				{
					$hint = $hint . "<br /><a href='" . 
					$z->item(0)->childNodes->item(0)->nodeValue . 
					"' target='_blank'>" . 
					$y->item(0)->childNodes->item(0)->nodeValue . "</a>";
				}
			}
		}
	}
}

if ($hint=="") {
	$response="no suggestion";
}
else
{
  $response=$hint;
}

echo $results;*/


?>