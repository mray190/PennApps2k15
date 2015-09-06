<?php

include "server.php";

function getAverageTimeBetweenScans($userID, $productID)
{
	mysqli_select_db($_SESSION["dbConnection"],"ShopBuddy");
	$result = mysqli_query($_SESSION["dbConnection"], "SELECT * FROM Scans WHERE productID = $productID AND userID = $userID
				ORDER BY time ASC");
	$scanTimesArray = Array();
	while($scan = mysqli_fetch_assoc($result)){
		array_push($scanTimesArray, strtotime($scan["time"]));
	}
	$scanTimesDifferences = Array();
	for($i = 1; $i < count($scanTimesArray); $i++)
	{
		$scanTimesDifferences[$i - 1] = $scanTimesArray[$i] - $scanTimesArray[$i - 1];
	}
	return (array_sum($scanTimesDifferences) / count($scanTimesDifferences));
}

function predictNextPurchase($userID, $productID, $addScan = false)
{
	mysqli_select_db($_SESSION["dbConnection"],"calendar");
	$result = mysqli_fetch_assoc(mysqli_query($_SESSION["dbConnection"], "SELECT * FROM events WHERE user = $userID AND product = $productID"));
	if($result["id"] != null)
	{
		$eventID = $result["id"];
		mysqli_query($_SESSION["dbConnection"], "DELETE FROM events WHERE id = $eventID");
	}


	mysqli_select_db($_SESSION["dbConnection"],"ShopBuddy");

	if($addScan)
        {
                mysqli_query($_SESSION["dbConnection"], "INSERT INTO Scans (quantity, productID, userID) VALUES (1, $productID, $userID)");
        }

	$result = mysqli_query($_SESSION["dbConnection"], "SELECT * FROM Scans WHERE productID = $productID AND userID = $userID  ORDER BY time DESC");

	if(mysqli_num_rows($result) > 1)
	{
		$mostRecentScan = mysqli_fetch_assoc($result);
		$averageTimeBetweenScans = getAverageTimeBetweenScans($userID, $productID);

		$predictedNextPurchase = strtotime($mostRecentScan["time"]) + $averageTimeBetweenScans;

		$predictedDate = date("Y-m-d H:i:s" , $predictedNextPurchase);

		$productInfo = mysqli_fetch_assoc(mysqli_query($_SESSION["dbConnection"], "SELECT * FROM Products WHERE id = $productID"));
		$url = $productInfo['url'];
		$title = $productInfo['name'];

		mysqli_select_db($_SESSION["dbConnection"],"calendar");
		$titleS = mysqli_real_escape_string($_SESSION["dbConnection"], $title);

		mysqli_query($_SESSION["dbConnection"], "INSERT into events (start, end, product, user, occurence, title, url) VALUES ('$predictedDate', '$predictedDate', $productID, $userID, $averageTimeBetweenScans, '$titleS', '$url')");
		echo mysqli_error($_SESSION["dbConnection"]);
		die();
		$result = mysqli_fetch_assoc(mysqli_query($_SESSION["dbConnection"], "SELECT id FROM events WHERE product = $productID AND user = $userID"));
		return $result["id"];
	}
	else {
		return -1;
	}
}

function sendTextMessage($userID, $url, $title)
{
	mysqli_select_db($_SESSION["dbConnection"], "ShopBuddy");
	$result = mysqli_fetch_assoc(mysqli_query($_SESSION["dbConnection"], "SELECT * FROM Users WHERE userID = $userID"));

	require "vendor/twilio/sdk/Services/Twilio.php";

        // set your AccountSid and AuthToken from www.twilio.com/user/account
        $AccountSid = "AC43c2e6c01b867e21cb224cc8f91d55c3";
        $AuthToken = "4ac2e55017596c3b5fb255bf46b9ff6f";

        $client = new Services_Twilio($AccountSid, $AuthToken);

        $message = $client->account->messages->create(array(
            "From" => "567-316-6272",
            "To" => $result['phoneNumber'],
            "Body" => "Shop-Buddy here!! Don't forget to order your " . $title . "! URL: " . substr($url,strpos($url,"=")),
        ));

}
