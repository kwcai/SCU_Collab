<?php
	session_start();
	include_once '../svr_config.php';

	$user_check = $_SESSION['user'];

	$result = mysqli_query($db, "SELECT name_first AND name_last FROM user_log WHERE email='$user_check'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$current_user=$row['name_first'] . " " . $row['name_last'];
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>Hello, <em><?php echo $current_user;?>!</em></h1>
		<h1>SCU Collab</h1>
		<h2>Create Group</h2>
		<h2>Join Group</h2>
		<h2>View Groups</h2>
		<h2>View Calendar</h2>
		<a href="logout.php" style="font-size:18px">Logout</a>
	</body>
</html>