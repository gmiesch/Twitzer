<?php
	session_start();

	if(isset($_POST['submit'])) {
        $twitterUsername = $_POST['inputTwitterName'];
        $numTweets = $_POST['inputNumTweets'];

		echo $twitterUsername . $numTweets;
	}
?>
