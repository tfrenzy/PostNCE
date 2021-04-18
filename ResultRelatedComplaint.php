<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Creative One Page Parallax Template">
<meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
<meta name="author" content=""> 
<title>Result Related Complaint</title> 
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
<div id="contact-form-section">
<div class="status alert alert-success" style="display: none"></div>
<?php
include("Connect.php");
$nu = new Connect();
if ((isset($_SESSION['User']))&&($nu->isConfirmed($_SESSION['User']))) {
if (isset($_POST['submit2'])) {
if (isset($_POST['wrongscore'])) $wrongscore = "true";
else $wrongscore = "false";
if (isset($_POST['wrongaddtn'])) $wrongaddtn = "true";
else $wrongaddtn = "false";
if (isset($_POST['missingassesscore'])) $missingassesscore = "true";
else $missingassesscore = "false";
if (isset($_POST['missingexamscore'])) $missingexamscore = "true";
else $missingexamscore = "false";
if (isset($_POST['noresult'])) $noresult = "true";
else $noresult = "false";
if (isset($_POST['tworesults'])) $tworesults = "true";
else $tworesults = "false";
if (isset($_POST['wrongmatno'])) $wrongmatno = "true";
else $wrongmatno = "false";
if (isset($_POST['wrongname'])) $wrongname = "true";
else $wrongname = "false";
if (isset($_POST['others'])) $others = "true";
else $others = "false";
$nu->enterResultComplaint1($_SESSION['User'], $wrongscore, $wrongaddtn, $missingassesscore, $missingexamscore, $noresult, $tworesults, $wrongmatno, $_POST['correctmatno'], $wrongname, $_POST['correctname'], $others, $_POST['others_']); 
echo "<h3>Your complaints have been entered into the system</h3>";
}
else if (isset($_POST['submit1'])) {
$hui = $nu->enterResultComplaint($_SESSION['User'], $_POST['matricno'], $_POST['coursecode'], $_POST['coursetitle'], $_POST['dateattempted'], $_POST['courselecturer']);
if ($hui) {
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<label><u>List of Possible Problems (tick the ones applicable)</u></label></br>
<table border=0>
<tr><td><input type="checkbox" name="wrongscore"></td><td align="left"><label>Wrong addition of scores from individual question</label></td></tr>
<tr><td><input type="checkbox" name="wrongaddtn"></td><td align="left"><label>Wrong addition of exam score and continuous assessment score</label></td></tr>
<tr><td><input type="checkbox" name="missingassesscore"></td><td align="left"><label>Missing continuous assessment score</label></td></tr>
<tr><td><input type="checkbox" name="missingexamscore"></td><td align="left"><label>Missing exam score</label></td></tr>
<tr><td><input type="checkbox" name="noresult"></td><td align="left"><label>No result at all (ie Mat No not in the published result)</label></td></tr>
<tr><td><input type="checkbox" name="tworesults"></td><td align="left"><label>Two results with different grade</label></td></tr>
<tr><td><input type="checkbox" name="wrongmatno"></td><td align="left"><label>Wrong Matriculation Number</label></td></tr>
<tr><td></td><td align="left"><input type="text" name="correctmatno" placeholder="Enter Correct Mat. No."></td></tr>
<tr><td><input type="checkbox" name="wrongname"></td><td align="left"><label>Wrong Name</label></td></tr>
<tr><td></td><td align="left"><input type="text" name="correctname" placeholder="Enter Correct Name"></td></tr>
<tr><td><input type="checkbox" name="others"></td><td align="left"><label>Others such as appealing against published result</label></td></tr>
<tr><td></td><td align="left"><input type="text" name="others_" placeholder="Enter date"></td></tr>
</table>
<button type="submit" name="submit2" class="btn btn-primary">Finish</button>
</form>
<?php
}
else echo "<h3>Problems were encountered in entering you request. Please try again</h3>";
}
else {
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h3>Please Fill in details of the complaint below</h3>
<input type="text" name="matricno" class="form-control" required="required" placeholder="Enter your Matriculation Number"></br>
<input type="text" name="coursecode" class="form-control" required="required" placeholder="Enter Course Code"></br>
<input type="text" name="coursetitle" class="form-control" required="required" placeholder="Enter Course Title"></br>
<input type="text" name="dateattempted" class="form-control" required="required" placeholder="Enter Date Attempted"></br>
<input type="text" name="courselecturer" class="form-control" required="required" placeholder="Enter Course Lecturer"></br>
<button type="submit" name="submit1" class="btn btn-primary">Next</button>
</form>
<?php
}
}
else echo "<h3>You do not have permission to view this page. Your account may have expired or has not been confirmed.</br>Go back to <a href=index.php>Home Page</a>";
?>
</div>
</div>

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