<?php include 'php/checkIfDias13.php';?>

<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    
    <title>Twitzer</title>

    <!-- Latest compiled and minified CSS -->   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/flatly/bootstrap.min.css">

    <!--JQuery pulldown -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
	<!-- Custom styles for this template -->
    <link href="css/home.css" rel="stylesheet">

	<!-- Word cloud required files -->
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="js/cloud.js"></script>

  </head>

  <body>

    <div class="well bs-component" id="formWell">
      <form class="form-signin" action="" method="post">
        <h4 class="form-signin-heading">Select Parameters</h4>
        <label for="inputUsername" class="sr-only">Twitter Username</label>
        <input type="text" id="inputTwitterName" name="inputTwitterName" class="form-control" placeholder="Twitter Username" required autofocus>
        <label for="inputNumTweets" class="sr-only">Number of Tweets</label>
        <input type="number" id="inputNumTweets" name="inputNumTweets" class="form-control" max="1000" placeholder="Number of Tweets" required>
		<button class="btn btn-primary btn-block" name="submit" onclick="getTweets(); return false" type="submit">Submit</button>
      </form>
    </div>

	<h3 id="resultsTitle"></h3>
	
	<!-- Target container for word cloud -->
	<div class="well bs-component hidden" id="resultsWell">
		<div id="chart"></div>
	</div>

  </body>

  <footer class="footer">
      <div class="container">
          <p> Twitzer - Trinity University </p>
          <p><a class="btn btn-sm btn-primary" href="index.php" role="button"> Logout </a></p>
      </div>
  </footer>

	<script src="js/home.js"></script>

</html>


