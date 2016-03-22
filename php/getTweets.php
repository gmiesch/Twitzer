<?php
	session_start();

    $twitterUsername = $_POST['inputTwitterName'];
    $numTweets = $_POST['inputNumTweets'];

	echo $twitterUsername . $numTweets;
?>
