<?php

/*session_start();
*/
include('../svr_config.php');

			if(empty($_POST["g_name"]) || empty($_POST["description"]) || empty($_POST["password"]))
			{
				$error = "Fields are required";
			} else
			{
				$g_name = mysqli_real_escape_string($db, $_POST['g_name']);
				$description = mysqli_real_escape_string($db, $_POST['description']);

				$user = mysqli_real_escape_string($db, $_POST['user']);

				$pass = mysqli_real_escape_string($db, $_POST['password']);
				$pass = md5($pass);

				/*$stmt = $db->prepare("SELECT group_id FROM groups WHERE group_name = ?");
				$stmt->bind_param("s", $g_name);*/


				$sql = "SELECT group_id FROM groups WHERE group_name = $g_name";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				

				if(mysqli_num_rows($result) == 1)
				{
				?>
					<script>alert('This group name has already been taken');</script>
				<?php
				}
				if(mysqli_query($db, "INSERT INTO groups (group_name, owner_id, password, description) VALUES ($g_name, $u_id, $pass, $description)"))
				{
				?>
					<script>alert('Your group has been successfully created');</script>
				<?php
					$userinfo = mysqli_query($db, "SELECT user_id FROM users WHERE username = $user");
					$user_result = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);
					mysqli_query($db, "INSERT INTO usersTOgroups (user_id, group_id) VALUES ($user_result['user_id'])");
				}
				else
				{
				?>
					<script>alert('error');</script>
				<?php
				}
			}

			echo $error;


/*
$stmt1 = mysqli_prepare($db, "SELECT * FROM groups WHERE group_name = ?");

mysqli_stmt_bind_param($stmt1, "s", $group_name);
$group_name = $_POST['g_name'];

echo $group_name;

mysqli_stmt_execute($stmt1);
$result = mysqli_stmt_fetch($stmt1); //returns NULL if table is empty

if($result != NULL)
{
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if(mysqli_num_rows($result) == 1)
	{
		?>
			<script>alert('This group name has already been used');</script>
		<?php
	}
	else
	{
		$stmt2 = mysqli_prepare($db, "INSERT INTO groups (group_name, owner_id, password, description) VALUES (?, ?, ?, ?)");
		mysqli_stmt_bind_Param($stmt2, "siss", $group_name, $owner_id, $password, $description);

		$owner_id = '1';
		$password = $_POST['password'];
		$description = $_POST['description'];
		//$group_owner = "SELECT User_ID FROM user_log WHERE email = '$user_check'";

		mysqli_stmt_execute($stmt2);

		if(mysqli_stmt_execute($stmt2))
		{
			echo "Successfully created group";
		}
		else
		{
			echo "Error";
		}
	}
}
else
{
	$stmt2 = mysqli_prepare($db, "INSERT INTO groups (group_name, owner_id, password, description) VALUES (?, ?, ?, ?)");
	mysqli_stmt_bind_Param($stmt2, "siss", $group_name, $owner_id, $password, $description);

	$owner_id = '1';
	$password = $_POST['password'];
	$description = $_POST['description'];
	//$group_owner = "SELECT User_ID FROM user_log WHERE email = '$user_check'";

	if(mysqli_stmt_execute($stmt2))
	{
		echo "Successfully created group";
	}
	else
	{
		echo "Error";
	}
}*/
?>