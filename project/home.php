<?php
	session_start();
	include_once '../svr_config.php';
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
	}
	$result = mysqli_query($db, "SELECT * FROM user_log WHERE user_id=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<h1>SCU Collab</h1>
		<h2>Create Group</h2>
		<h2>Join Group</h2>
		<h2>View Groups</h2>
		<h2>View Calendar</h2>
	</body>
</html>