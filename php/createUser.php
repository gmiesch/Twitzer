<?php
	session_start();

	$servername = '127.0.0.1';
    $username = 'gvonrose';
    $password = '0750466';
    $database = 'gvonrose';

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $database);

    //$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if(isset($_POST['submit'])) {
        $username = $_POST['inputUsername'];
        $password = $_POST['inputPassword'];

        $username = trim($username);
        $username = stripslashes($username);
        $username = htmlspecialchars($username, ENT_QUOTES);
        $password = trim($password);
        $password = stripslashes($password);
        $password = htmlspecialchars($password, ENT_QUOTES);

        $sql = "INSERT INTO Twitzer_User (username, password) VALUES ('$username', '$password');";

        if($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
	}
?>

