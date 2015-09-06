<?php
session_start();

if(isset($_POST))
{
	$_SESSION["userID"] = $_POST["userID"];
	return;
}
