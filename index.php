<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<?php
	session_start();
	if(isset($_SESSION["userID"]))
	{
		header("Location: home.php");
		exit();
	}
?>

<p>UserID:</p><br>
<input type="text" name="userID" id="userID">
<button type="button" id="submitButton">Submit</button>

<script type="text/javascript">
$(document).ready(function(){
	$("#submitButton").click(function(){
        $.ajax({
            type: 'POST',
            data: { userID: $('#userID').val() },
            url: 'setSession.php',
            success: function(data) {
                window.location.replace("home.php");
            }
        });
	   });
	});
</script>
