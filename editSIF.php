<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Creative One Page Parallax Template">
<meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
<meta name="author" content=""> 
<title>Edit Students Information</title> 
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
if (isset($_POST['submit_'])) {
$nu->enterSubject($_SESSION['User'], $_POST['subject'], $_POST['examno'], $_POST['examcenter'], $_POST['dates']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h6>Fill in the Details</h6>
Click <a href="" data-toggle="modal" data-target="#subject-detail">here</a> to view Already Filled Results
<div class="modal fade" id="subject-detail" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<table border=1>
<th><td>Subject</td><td>Candidate's exam no</td><td>Examination center</td><td>Dates</td></th>
<?php $nu->loadSubjects($_SESSION['User']); ?>
</table>
</div> 
</div>
</div>
</div>
</br>
<input type="text" name="subject" class="form-control" placeholder="Enter Subject"></br>
<input type="text" name="examno" class="form-control" placeholder="Enter Exam No"></br>
<input type="text" name="examcenter" class="form-control" placeholder="Enter Exam Center"></br>
<input type="text" name="dates" class="form-control" placeholder="Enter Dates"></br>

<button type="submit" name="submit_" class="btn btn-primary">Enter New Subject</button>
<button type="submit" name="submit6" class="btn btn-primary">Next</button>
</form>
<?php	
}
else if (isset($_POST['submit7'])) {
$hu = $nu->editSIF7($_SESSION['User'], $_POST['name2'], $_POST['college2']);
if ($hu) {
echo "<h3>Your registration has been successfully edited</h3>";
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit6'])) {
$hu = true;
if ($hu) {
$tru = $nu->displaySIF7($_SESSION['User']);
?>

<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<p> I <input type="text" name="name2" value="<?php echo $tru[0] ?>"> of the College/Faculty of <input type="text" name="college2" value="<?php echo $tru[1] ?>"> agree that my studentship be withdrawn if it is found
 that I have given false information in my registration forms. I solemnly and sincerely promise and declare that I will respect and be obedient to the 
 Vice Chancellor and other officers of the University, and that I will faithfully observe all regulations which may from time to time be issued for the good order and 
 governance of the University. I denounce membership of secret societies. I also solemnly promise to obey all Senate regulations on academic programmes and procedures.</p></br>
<button type="submit" name="submit7" class="btn btn-primary">Finish</button>
</form>
<?php
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit5'])) {
$hu = $nu->editSIF5($_SESSION['User'], $_POST['qualificationinview'], $_POST['modeofstudy'], $_POST['normalcourseduration'], $_POST['extracurricular'], $_POST['healthstatus'], $_POST['disabletype'], $_POST['medicationtype']);
if ($hu) {
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h6>Fill in the Details</h6>
Click <a href="" data-toggle="modal" data-target="#subject-detail">here</a> to view Already Filled Results
<div class="modal fade" id="subject-detail" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<table border=1>
<th><td>Subject</td><td>Candidate's exam no</td><td>Examination center</td><td>Dates</td></th>
<?php $nu->loadSubjects($_SESSION['User']); ?>
</table>
</div> 
</div>
</div>
</div>
</br>
<input type="text" name="subject" class="form-control" placeholder="Enter Subject"></br>
<input type="text" name="examno" class="form-control" placeholder="Enter Exam No"></br>
<input type="text" name="examcenter" class="form-control" placeholder="Enter Exam Center"></br>
<input type="text" name="dates" class="form-control" placeholder="Enter Dates"></br>

<button type="submit" name="submit_" class="btn btn-primary">Enter New Subject</button>
<button type="submit" name="submit6" class="btn btn-primary">Next</button>
</form>
<?php
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit4'])) {
$hu = $nu->editSIF4($_SESSION['User'], $_POST['institutionobtained'], $_POST['dateobtained'], $_POST['subjectfirstdegree'], $_POST['yearofentry'], $_POST['collegeofentry'], $_POST['facultyofentry'], $_POST['deptofentry']);
if ($hu) {
$tru = $nu->displaySIF5($_SESSION['User']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<input type="text" name="qualificationinview" class="form-control" required="required" value="<?php echo $tru[0] ?>"></br>
<input type="text" name="modeofstudy" class="form-control" required="required" value="<?php echo $tru[1] ?>"></br>
<input type="text" name="normalcourseduration" class="form-control" required="required" value="<?php echo $tru[2] ?>"></br>
<input type="text" name="extracurricular" class="form-control" required="required" value="<?php echo $tru[3] ?>"></br>
<input type="text" name="healthstatus" class="form-control" value="<?php echo $tru[4] ?>"></br>
<input type="text" name="disabletype" class="form-control" value="<?php echo $tru[5] ?>"></br>
<input type="text" name="medicationtype" class="form-control" value="<?php echo $tru[6] ?>"></br>
<button type="submit" name="submit5" class="btn btn-primary">Next</button>
</form> 
<?php	
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit3'])) {
$hu = $nu->editSIF3($_SESSION['User'], $_POST['namesponsor'], $_POST['sponsoraddress'], $_POST['phonesponsor'], $_POST['modeofentry'], $_POST['prevuniversity'], $_POST['programtype'], $_POST['qualification']);
if ($hu) {
$tru = $nu->displaySIF4($_SESSION['User']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<input type="text" name="institutionobtained" class="form-control" required="required" value="<?php echo $tru[0] ?>"></br>
<input type="text" name="dateobtained" class="form-control" required="required" value="<?php echo $tru[1] ?>"></br>
<input type="text" name="subjectfirstdegree" class="form-control" value="<?php echo $tru[2] ?>"></br>
<input type="number" name="yearofentry" class="form-control" required="required" value="<?php echo $tru[3] ?>"></br>
<input type="text" name="collegeofentry" class="form-control" required="required" value="<?php echo $tru[4] ?>"></br>
<input type="text" name="facultyofentry" class="form-control" required="required" value="<?php echo $tru[5] ?>"></br>
<input type="text" name="deptofentry" class="form-control" required="required" value="<?php echo $tru[6] ?>"></br>
<button type="submit" name="submit4"  class="btn btn-primary">Next</button>
</div>
</form> 
<?php
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit2'])) {
$hu = $nu->editSIF2($_SESSION['User'], $_POST['permaddress'], $_POST['contactaddress'], $_POST['namenextofkin'], $_POST['nextofkinaddress'], $_POST['relnextofkin'], $_POST['phonenextofkin']);
if ($hu) {
$tru = $nu->displaySIF3($_SESSION['User']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<input type="text" name="namesponsor" class="form-control" required="required" value="<?php echo $tru[0] ?>"></br>
<textarea name="sponsoraddress" class="form-control" required="required"><?php echo $tru[1] ?></textarea></br>
<input type="number" name="phonesponsor" class="form-control" required="required" value="<?php echo $tru[2] ?>"></br>
<input type="text" name="modeofentry" class="form-control" required="required" value="<?php echo $tru[3] ?>"></br>
<input type="text" name="prevuniversity" class="form-control" value="<?php echo $tru[4] ?>"></br>
<input type="text" name="programtype" class="form-control" value="<?php echo $tru[5] ?>"></br>
<input type="text" name="qualification" class="form-control" value="<?php echo $tru[6] ?>"></br>
<button type="submit" name="submit3" class="btn btn-primary">Next</button>
</form>
<?php
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else if (isset($_POST['submit1'])) {
$hu = $nu->editSIF1($_SESSION['User'], $_POST['fullname'], $_POST['maidenname'], $_POST['regno'], $_POST['placeoforigin'], $_POST['maritalstatus'], $_POST['religion']);
if ($hu) {
$tru = $nu->displaySIF2($_SESSION['User']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<textarea name="permaddress" class="form-control" required="required"><?php echo $tru[0] ?></textarea></br>
<textarea name="contactaddress" class="form-control" required="required"><?php echo $tru[1] ?></textarea></br>
<input type="text" name="namenextofkin" class="form-control" required="required" value="<?php echo $tru[2] ?>"></br>
<textarea name="nextofkinaddress" class="form-control" required="required"><?php echo $tru[3] ?></textarea></br>
<input type="text" name="relnextofkin" class="form-control" required="required" value="<?php echo $tru[4] ?>"></br>
<input type="number" name="phonenextofkin" class="form-control" required="required" value="<?php echo $tru[5] ?>"></br>
<button type="submit" name="submit2" class="btn btn-primary">Next</button>
</div>
</form>
<?php	
}
else echo "<h3>Problems were encountered entering the information. Please check your inputs and try again</h3>";
}
else {
$tru = $nu->displaySIF1($_SESSION['User']);
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<h3>Fill in the Details</h3>
<input type="text" name="fullname" class="form-control" required="required" value="<?php echo $tru[0] ?>"></br>
<input type="text" name="maidenname" class="form-control" value="<?php echo $tru[1] ?>"></br>
<input type="text" name="regno" class="form-control" required="required" value="<?php echo $tru[2] ?>"></br>
<input type="text" name="placeoforigin" class="form-control" required="required" value="<?php echo $tru[3] ?>"></br>
<input type="text" name="maritalstatus" class="form-control" value="<?php echo $tru[4] ?>"></br>
<input type="text" name="religion" class="form-control" value="<?php echo $tru[5] ?>"></br>
<button type="submit" name="submit1" class="btn btn-primary">Next</button>
</div>
</form> 
<?php
}
?>
</div>
<?php
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