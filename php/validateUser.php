<?php
	session_start();

    $servername = '127.0.0.1';
    $username = 'gvonrose';
    $password = '0750466';
    $database = 'gvonrose';

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $database);

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

        $sql = "SELECT COUNT(*) as count FROM Twitzer_User WHERE username='".$username."' AND password='".$password."';";
        //echo $sql;
        //echo "<br>";


        //Check if username and password were valid
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row["count"] == 1) {
                    echo "login successful";
					$conn->close();
					$_SESSION["username"] = $username;
                    header("Location: home.php");
                }
                else {
					echo "<div class=\"alert alert-dismissible alert-danger\">";
                	echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">X</button>";
					echo "Invalid username or password, please try again.";
					echo "</div>";
				}
            }
        } else {
            echo "No results - invalid DB or Query?";
        }
		$conn->close();
	}
?>

