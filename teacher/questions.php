<?php
session_start();
include '../includes/database.inc.php';

$dbConn = getDatabaseConnection(); //gets database connection

if (!isset($_SESSION['username'])) {  //checks whether user has logged in
	
	header('Location: ../index.php');
	
}


if(!empty($_GET['classId'])){
    $_SESSION['classId'] = $_GET['classId'];
}
if (!isset($_SESSION['username'])) {  //checks whether user has logged in
	
	header('Location: ../index.php');
	
}


function displayLectures(){
	
	global $dbConn;
	

$sql = "SELECT * FROM lecture	
		WHERE classId = {$_SESSION['classId']}";

	$records = getDataBySQL($sql);
	
	//print_r($records);

  return $records;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Lecuture</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
 integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="../css/styles.css">
  
</head>

<body>
  <div class="container">
    <header>
    <div class="row">
       <div class="col-md-12 white-background">
      <h1> Lecture</h1>
      <br />
      </div> 
      </div>
     
    </header>
    <br />
    <div class="row">
       <div class="col-md-6">
          <strong><h3> Welcome <?=$_SESSION['fName']?>! <h3></strong>  
       </div>
       <div class="col-md-2 top-button-padding">
          <form action="addCodeGenorator.php" method="get">
	         <input type="hidden" name="classId" value="<?=$_GET['classId']?>" />
             <input type="submit" id="addLecture" class="btn btn-default btn-md btn-primary" value="Add Lecture" name="addLecture" />	
          </form>
       </div>
       <div class="col-md-2 top-button-padding">
          <form action="studentReports.php?studentId="<?=$_GET['classId']?>"">
             <input type="submit" id="logout-button" class="btn btn-default btn-md btn-primary" value="Get Add Code" />	
          </form>
       </div>
       <div class="col-md-2 top-button-padding">
          <form action="../logout.php">
             <input type="submit" id="logout-button" class="btn btn-default btn-md btn-primary" value="Logout" name="logout" />	
          </form>
       </div>
    </div>
    <div>
    <hr />
	 
     <br /><br />	
    </div>
	<div class="row">
       <div class="col-md-1">
       </div>
       <div class="col-md-4">
	   <?php
			$records = displayLectures();
	   echo "<table class='table-bordered'>";
	   foreach ($records as $record) {
		   echo "<tr>";
		   echo "<td>";
		   echo "<h5 class='word-padding'>Lecure Name:</h5>";
		   echo "<td>";
		   echo "<h5 class='word-padding'>{$record['lectureName']}</h5>";
		   echo "</td>";
		   echo "<td>";
	       echo "<a href='getQuestions.php?lectureId= {$record['lectureId']}' target ='getQuestionIframe'>
                    <span class='glyphicon glyphicon-folder-open icon-padding'></span>
                </a>";
		   echo "</td>";
		   echo "<td>";
		   echo "<a href='createQuestion.php?lectureId= {$record['lectureId']}'>
                    <span class='glyphicon glyphicon-plus-sign icon-padding'></span>
                 </a>";
		   echo "</td>";
		   echo "</tr>";
	}
	echo "</table>";
	   ?>
	</div>
	<div class="col-md-4">
	   <iframe id="iframe" src="getQuestions.php" name="getQuestionIframe" width="500" height="500" frameborder="0">
       </iframe>
	</div>
    <div class="col-md-3">
    </div>
    </div>
    <footer id="footer">
			<hr />
			<p> the information included on this page may not be correct, it was created in CST336 &copy; Joshua Smith 2015</p>
			
			<img class="image-with border" src="../../img/csumb-logo.png" alt="csumb logo" />
			
		</footer>
  </div>
</body>
</html>
