<?php
	session_start();
	include_once 'databaseconnect.php';
	
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
	}
	$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>