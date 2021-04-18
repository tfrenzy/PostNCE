<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Creative One Page Parallax Template">
<meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
<meta name="author" content=""> 
<title>Course Registration</title> 
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/prettyPhoto.css" rel="stylesheet"> 
<link href="css/font-awesome.min.css" rel="stylesheet"> 
<link href="css/animate.css" rel="stylesheet"> 
<link href="css/main.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet"> 
<!--[if lt IE 9]> <script src="js/html5shiv.js"></script> 
<script src="js/respond.min.js"></script> <![endif]--> 
<link rel="shortcut icon" href="images/ico/favicon.png"> 
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png"> 
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png"> 
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png"> 
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
<div class="preloader">
<div class="preloder-wrap">
<div class="preloder-inner"> 
<div class="ball"></div> 
<div class="ball"></div> 
<div class="ball"></div> 
<div class="ball"></div> 
<div class="ball"></div> 
<div class="ball"></div> 
<div class="ball"></div>
</div>
</div>
</div><!--/.preloader-->
<header id="navigation"> 
<div class="navbar navbar-inverse navbar-fixed-top" role="banner"> 
<div class="container"> 
<div class="navbar-header"> 
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
</button> 
<a class="navbar-brand" href="index.php"><h1><img src="images/logo.png" alt="logo"></h1></a> 
</div> 
<div class="collapse navbar-collapse"> 
<?php
if (isset($_SESSION['User'])) {include("navbar.php");}
?> 
</div> 
</div> 
</div><!--/navbar--> 
</header> <!--/#navigation--> 
<section id="contact">
<div class="container">
<div class="contact-details">
<div class="row text-center clearfix">
<div class="col-sm-6"> 
<?php
include("Connect.php");
$nu = new Connect();
if ((isset($_SESSION['User']))&&($nu->isConfirmed($_SESSION['User']))) {
?>
<div id="contact-form-section">
<div class="status alert alert-success" style="display: none"></div>
<?php
if (isset($_POST['submit'])) {
$nu->enterCourse($_SESSION['User'], $_POST['coursetitle'], $_POST['coursecode'], $_POST['creditunit'], $_SESSION['yrofstudy']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h3>Fill in courses for the session</h3></br>
<input type="text" name="coursetitle" class="form-control" placeholder="Enter Course Title"></br></br>
<input type="text" name="coursecode" class="form-control" placeholder="Enter Course Code"></br></br>
<input type="number" name="creditunit" class="form-control" placeholder="Enter Credit Unit"></br></br>
</br>
<button type="submit" name="submit" class="btn btn-primary">Enter New Course</button>
</form>
<?php
}
else if (!isset($_SESSION['yrofstudy'])) {
if (!isset($_POST['submit_'])) {
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<select name="yrofstudy" class="form-control">
<option value="-1">Select Your Year Of Study</option>
<option value="1">First Year</option>
<option value="2">Second Year</option>
<option value="3">Third Year</option>
<option value="4">Fourth Year</option>
</select></br>
<button type="submit" name="submit_" class="btn btn-primary">Proceed</button>
</form>
<?php
}
else {
if ($_POST['yrofstudy'] < 0) {
echo "<h3>Select a valid year</h3>";
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<select name="yrofstudy" class="form-control">
<option value="-1">Select Your Year Of Study</option>
<option value="1">First Year</option>
<option value="2">Second Year</option>
<option value="3">Third Year</option>
<option value="4">Fourth Year</option>
</select></br>
<button type="submit" name="submit_" class="btn btn-primary">Proceed</button>
</form>
<?php
}
else {
$_SESSION['yrofstudy'] = $_POST['yrofstudy'];
if (isset($_POST['submit'])) {
$nu->enterCourse($_SESSION['User'], $_POST['coursetitle'], $_POST['coursecode'], $_POST['creditunit'], $_SESSION['yrofstudy']);
}
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h3>Fill in courses for the session</h3></br>
<input type="text" name="coursetitle" class="form-control" placeholder="Enter Course Title"></br></br>
<input type="text" name="coursecode" class="form-control" placeholder="Enter Course Code"></br></br>
<input type="number" name="creditunit" class="form-control" placeholder="Enter Credit Unit"></br></br>
</br>
<button type="submit" name="submit" class="btn btn-primary">Enter New Course</button>
</form>
<?php
}
}
}
else {
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h3>Fill in courses for the session</h3></br>
<input type="text" name="coursetitle" class="form-control" placeholder="Enter Course Title"></br></br>
<input type="text" name="coursecode" class="form-control" placeholder="Enter Course Code"></br></br>
<input type="number" name="creditunit" class="form-control" placeholder="Enter Credit Unit"></br></br>
</br>
<button type="submit" name="submit" class="btn btn-primary">Enter New Course</button>
</form>
<?php
}
?>
</div>
</div>
<div class="col-sm-6"> 
<div id="contact-form-section">
<div class="status alert alert-success" style="display: none"></div>

<table border=1 align="center" >
<tr><td>Course Code</td><td>Course Title</td><td>Credit Units</td></tr>
<?php if (isset($_SESSION['yrofstudy'])) $nu->loadRegisteredCourses($_SESSION['User'], $_SESSION['yrofstudy']); ?>
</table></br>
</div>
</div>
<?php
}
else echo "<h3>You do not have permission to view this page. Your account may have expired or has not been confirmed.</br>Go back to <a href=index.php>Home Page</a>";
?>
</div>
</div>
</div>
 
</section> <!--/#contact--> 
<footer id="footer"> 
<div class="container"> 
<div class="text-center"> 
<p>Copyright &copy; 2017 - <a href="http://jaysoftnigeria.com/">JaySoft Global Resources</a> | All Rights Reserved</p> 
</div> 
</div> 
</footer> <!--/#footer--> 

<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script> 
<script type="text/javascript" src="js/jquery.parallax.js"></script> 
<script type="text/javascript" src="js/main.js"></script> 
</body>
</html>