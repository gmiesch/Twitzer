<?php
	session_start();

	$servername = '127.0.0.1';
    $username = 'unknownproject';
    $password = 'hack3r1sbad';
    $database = 'unknownproject';

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

		$checkExists = "SELECT * from Twitzer_User where username='" . $username . "';";
        $result = $conn->query($checkExists);

        if($result->num_rows == 0) {
            $sql = "INSERT INTO Twitzer_User (username, password) VALUES ('$username', '$password');";
            if($conn->query($sql) === TRUE) {
                $conn->close();
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                header("Location: home.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<div class=\"alert alert-dismissible\">";
             echo "<button type=\"button\" class=\"close\" data-dismiss    =\"alert\">X</button>";
             echo "Username already taken";
            echo "</div>";
        }
    }
?>
