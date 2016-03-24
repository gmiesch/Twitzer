<?php
	session_start();
	
	// Variables from post
	$rawUsername = $_POST['inputTwitterUsername'];
	$rawCount = $_POST['inputNumTweets'];

	$rawCount = min(200, $rawCount);	
	// Auth Keys from text file
	$keyFile = fopen("keys.txt", "r") or die("No keys.txt file found!");
	$line = fgets($keyFile);
	$consumerKey = $line;
	$consumerKey = trim($consumerKey);
	$line = fgets($keyFile);
	$consumerSecret = $line;
	$consumerSecret = trim($consumerSecret);
	fclose($keyFile);

	// Get base signature	
	$timestamp = time();
	$nonce = md5(mt_rand());
	$user = "&screen_name=" . $rawUsername;
	$count = "count=" . $rawCount . "&"; 
	$signatureBaseString = "GET&" . rawurlencode("https://api.twitter.com/1.1/statuses/user_timeline.json") . "&" . rawurlencode($count)
		. rawurlencode("oauth_consumer_key=" . rawurlencode($consumerKey)
				. "&oauth_nonce=" . rawurlencode("$nonce")
				. "&oauth_signature_method=" . rawurlencode("HMAC-SHA1")
				. "&oauth_timestamp=" . $timestamp
				. "&oauth_version=" . "1.0" . $user);

	// HMAC-SHA1 Encoding of base signature
	$sig = rawurlencode(base64_encode(hash_hmac("sha1", $signatureBaseString, $consumerSecret . "&", true)));

	// Make cURL command
	$res = "curl --get 'https://api.twitter.com/1.1/statuses/user_timeline.json' --data '" . $count . substr($user,1) . "' --header 'Authorization: OAuth "
		. "oauth_consumer_key=\"" . $consumerKey . "\", "
		. "oauth_nonce=\"" . $nonce . "\", "
		. "oauth_signature=\"" . $sig . "\", "
		. "oauth_signature_method=\"HMAC-SHA1\", "
		. "oauth_timestamp=\"" . $timestamp . "\", "
		. "oauth_version=\"1.0\"'";
		
	echo exec($res);
?>
