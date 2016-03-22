<?php
    session_start();

    $servername = '127.0.0.1';
    $username = 'unknownproject';
    $password = 'hack3r1sbad';
    $database = 'unknownproject';

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];
	$username = trim($username);
    $username = stripslashes($username);
    $username = htmlspecialchars($username, ENT_QUOTES);

	$sqlGetUserId = "SELECT user_id FROM Twitzer_User where username='$username';";
	$result = $conn->query($sqlGetUserId);
	$userId = 0;
	while($row = $result->fetch_assoc()) {
		$userId = ($row['user_id']);	
	}

    $sql = "SELECT * FROM Twitzer_User_History where owner='$userId';";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo $row['tweetUsername'] . "|" . $row['numTweets'] . "|" . $row['id'] . "|";
	}
?>
