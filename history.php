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
    <link href="css/history.css" rel="stylesheet">

	<!-- Word cloud required files -->
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="js/cloud.js"></script>

  </head>

  <body>

  <div class="well bs-component" id="tableWell">
    <table class="table table-hover" id="searchHistory">
	</table> 
  </div>


  </body>

  <footer class="footer">
      <div class="container">
          <p> Twitzer - Trinity University </p>
          <p><a class="btn btn-sm btn-primary" href="index.php" role="button"> Logout </a></p>
      </div>
  </footer>

	<script src="js/history.js"></script>

</html>


