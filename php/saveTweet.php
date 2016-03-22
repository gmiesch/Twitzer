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
	$twitterUsername = $_POST['inputTwitterUsername'];
    $numTweets = $_POST['inputNumTweets'];
	$json = $_POST['json'];

    $username = trim($username);
    $username = stripslashes($username);
    $username = htmlspecialchars($username, ENT_QUOTES);
    $twitterUsername = trim($twitterUsername);
    $twitterUsername = stripslashes($twitterUsername);
    $twitterUsername = htmlspecialchars($twitterUsername, ENT_QUOTES);
    $numTweets = trim($numTweets);
    $numTweets = stripslashes($numTweets);
    $numTweets = htmlspecialchars($numTweets, ENT_QUOTES);

	$sqlGetUserId = "SELECT user_id FROM Twitzer_User where username='$username';";
	$result = $conn->query($sqlGetUserId);
	$userId = 0;
	while($row = $result->fetch_assoc()) {
		$userId = ($row['user_id']);	
	}

    $sql = "INSERT INTO Twitzer_User_History (owner, tweetUsername, numTweets, json) VALUES ('$userId', '$twitterUsername', '$numTweets', '$json');";

	$conn->query($sql);

?>
