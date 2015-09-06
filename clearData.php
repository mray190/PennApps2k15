<?php
	include 'server.php';

	if(isset($_POST))
	{
		switch ($_POST["clear"]) {
			case '0':
				mysqli_query($_SESSION["dbConnection"], "TRUNCATE TABLE Products");
				break;
			case '1':
				$userID = $_SESSION["userID"];
				mysqli_query($_SESSION["dbConnection"], "DELETE FROM Scans WHERE userID = $userID");
				break;
			case '2':
				 $userID = $_SESSION["userID"];
				mysqli_select_db($_SESSION["dbConnection"], "calendar");

				mysqli_query($_SESSION["dbConnection"], "DELETE FROM events WHERE user = $userID");
				mysqli_select_db($_SESSION["dbConnection"], "ShopBuddy");
				break;
			default:
				break;
		}
	}
