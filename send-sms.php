<?php
	require "vendor/twilio/sdk/Services/Twilio.php";
 
	// set your AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "AC43c2e6c01b867e21cb224cc8f91d55c3";
	$AuthToken = "4ac2e55017596c3b5fb255bf46b9ff6f";
 
	$client = new Services_Twilio($AccountSid, $AuthToken);
	 
	$message = $client->account->messages->create(array(
	    "From" => "567-316-6272",
	    "To" => "419-205-6834",
	    "Body" => "Test message!",
	));
 
	// Display a confirmation message on the screen
	echo "Sent message {$message->sid}";
