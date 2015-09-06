<?php

include "server.php";
include "functions.php";

mysqli_select_db($_SESSION["dbConnection"], 'calendar');

$start = microtime(true);
set_time_limit(60);
for ($i = 0; $i < 59; ++$i) {
	$results = mysqli_query($_SESSION["dbConnection"], "SELECT * FROM events WHERE start < NOW()");
	if(mysqli_num_rows($results) > 0)
	{
		while($row = mysqli_fetch_assoc($results))
		{
			sendTextMessage($row["user"], $row["url"], $row["title"]);
			predictNextPurchase($row["user"], $row["product"], true);
		}
	}
	time_sleep_until($start + $i + 1);
}
