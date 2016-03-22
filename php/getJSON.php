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

	$historyId = $_POST['historyId'];

    $sql = "SELECT * FROM Twitzer_User_History where id='$historyId';";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		echo $row['json'];
	}
?>
