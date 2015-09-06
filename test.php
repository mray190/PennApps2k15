<?php
require_once 'lib/AmazonECS.class.php';
include 'functions.php';

$client = new AmazonECS('AKIAILXUEK7DFVAQJL4Q', 'JhrTzoQfgIy/Ba6lptKKv9//gJwMDr4HU3tqXJJX', 'com', 'crawfis-20');
$client->setReturnType(AmazonECS::RETURN_TYPE_ARRAY);
$response  = $client->lookup($_GET['code']);
//check that there are items in the response
if (isset($response['Items']['Item']) ) {

    //loop through each item
    // foreach ($response['Items']['Item'] as $result) {
	$result = $response['Items']['Item'][0];

        //check that there is a ASIN code - for some reason, some items are not
        //correctly listed. Im sure there is a reason for it, need to check.
        if (isset($result['ASIN'])) {
            //store the ASIN code in case we need it
            $asin = $result['ASIN'];
            $url = "calendar/public/index.php?url=" . $result['DetailPageURL'];
            $name = $result['ItemAttributes']['Title'];

            //check that there is a URL. If not - no need to bother showing
            //this one as we only want linkable items
			$servername = "127.0.0.1";
			$username = "root";
			$password = "root123";
			$dbname = "ShopBuddy";

			// Create connection
			$mysqli = new mysqli($servername, $username, $password, $dbname);
			$sqlResult = $mysqli->query("SELECT * FROM Products WHERE aID='$asin'");
			if ($sqlResult->num_rows==0) {
				$sql = "INSERT INTO Products(aID, url, name) VALUES ('$asin','$url','" . mysqli_real_escape_string($_SESSION["dbConnection"],"$name") . "')";
                echo $sql;
				$mysqli->query($sql);
				$sqlResult = $mysqli->query("SELECT * FROM Products WHERE aID='$asin'");
			}
			$data = mysqli_fetch_assoc($sqlResult);
			$intID = $data['id'];
			$sql = "INSERT INTO Scans(`quantity`, `productID`, `userID`) VALUES (1,$intID,1)";
			$mysqli->query($sql);
            $eventID = predictNextPurchase(1, $intID);
			$mysqli->close();

            header ("location: " . $result['DetailPageURL']);
        }
    // }

} else {

}
?>