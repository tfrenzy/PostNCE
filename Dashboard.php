<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Creative One Page Parallax Template">
<meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
<meta name="author" content=""> 
<title>Dashboard</title> 
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
if (isset($_SESSION['User'])) {
include("Connect.php");
$nu = new Connect();
$nu->setCorrectNavBar();
}
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
if (isset($_SESSION['User'])) {
if ($nu->check_admin($_SESSION['User'])) {
?>
<ul class="nav nav-tabs">
<li class="active"><a href="#uploadresult" data-toggle="tab"><i class="fa fa-chain-broken"></i>Upload Result</a></li>
<li><a href="#createAdmin" data-toggle="tab"><i class="fa fa-th-large"></i>Create Admin</a></li>
<li><a href="#studentlist" data-toggle="tab"><i class="fa fa-th-large"></i>Student List</a></li>
<li><a href="#complaints" data-toggle="tab"><i class="fa fa-th-large"></i>Complaints</a></li>
<li><a href="#profile" data-toggle="tab"><i class="fa fa-th-large"></i>Profile</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane fade in active" id="uploadresult">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Upload results of a course by clicking <a href="UploadResult.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="createAdmin">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Create an administrative user by clicking <a href="createAdmin.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="studentlist">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Get a list of students according to year by clicking <a href="StudentYearList.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="complaints">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>View and handle all active complaints made by clicking <a href="HandleComplaints.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="profile">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>To access your profile page or change your login password, click <a href="Profile.php">here</a></p>
</div>
</div>
</div>
</div>
<?php
}
else if ($nu->check_lecturer($_SESSION['User'])) {
?>
<ul class="nav nav-tabs">
<li class="active"><a href="#uploadresult" data-toggle="tab"><i class="fa fa-chain-broken"></i>Upload Result</a></li>
<li><a href="#studentlist" data-toggle="tab"><i class="fa fa-th-large"></i>Student List</a></li>
<li><a href="#registercourse" data-toggle="tab"><i class="fa fa-th-large"></i>Register course to lecture</a></li>
<li><a href="#profile" data-toggle="tab"><i class="fa fa-th-large"></i>Profile</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane fade in active" id="uploadresult">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Upload results of a course you are handling by clicking <a href="UploadResultLect.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="studentlist">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Get a list of students offering a course you are handling by clicking <a href="StudentList.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="registercourse">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Register any course(s) that you are handling by clicking <a href="RegisterCourse.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="profile">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>To access your profile page or change your login password, click <a href="Profile.php">here</a></p>
</div>
</div>
</div>
</div>
<?php
}
else {
?>
<h3>Welcome <?php echo $nu->getPersonName($_SESSION['User'])?></h3>
<?php
if (!$nu->isConfirmed($_SESSION['User'])) echo "<h4>Your account is not active and you will not be able to register or check results</h4>";
?>
<ul class="nav nav-tabs">
<?php
if ($nu->isConfirmed($_SESSION['User'])) {
?>
<?php if ($nu->getLevel($_SESSION['User']) == 1) { ?>
<li class="active"><a href="#studentinfo" data-toggle="tab"><i class="fa fa-chain-broken"></i>Student Information Form</a></li>
<li><a href="#course" data-toggle="tab"><i class="fa fa-th-large"></i>Course Registration</a></li>
<?php }
else { ?>
<li class="active"><a href="#course" data-toggle="tab"><i class="fa fa-th-large"></i>Course Registration</a></li>
<?php 
}
if ($nu->getLevel($_SESSION['User']) > 3) { ?><li><a href="#waiver" data-toggle="tab"><i class="fa fa-users"></i>Waiver Form</a></li><?php } ?>
<li><a href="#results" data-toggle="tab"><i class="fa fa-th-large"></i>Check Results</a></li>
<li><a href="#complaints" data-toggle="tab"><i class="fa fa-users"></i>Complaint</a></li>
<li><a href="#profile" data-toggle="tab"><i class="fa fa-th-large"></i>Profile</a></li>
<?php
}
else {
?>
<li class="active"><a href="#payment" data-toggle="tab"><i class="fa fa-chain-broken"></i>Payment Information</a></li>
<li><a href="#profile" data-toggle="tab"><i class="fa fa-th-large"></i>Profile</a></li>
<?php
}
?>
</ul>
<div class="tab-content">
<?php
if ($nu->isConfirmed($_SESSION['User'])) {
if ($nu->getLevel($_SESSION['User']) == 1) {
?>
<div class="tab-pane fade in active" id="studentinfo">
<div class="media">
<img class="pull-left media-object" src="images/about-us/about.jpg" alt="about us"> 
<div class="media-body">
<?php
if ($nu->getSIFPercent($_SESSION['User']) < 100) {
?>
<p align="left">Make sure your information with us is up to date. Click <a href="SIF.php">here</a> to complete your student information form.</p><p align="left">This is compulsory for all students.</p><p align="left"> If you forget some details, you can log off and continue from where you stopped later.</p>
<?php
}
else {
?>
<p align="left">You have completed your student information registration. Click <a href="DownloadSIF.php" target="_blank">here</a> to download your student information form.</p><p>Click <a href="editSIF.php">here</a> to edit the information you've filled.</p><p align="left">If there are mistakes, you can delete the information you've filled by clicking <a href="DeleteSIF.php">here</a> and fill it again.</p>
<?php
}
?>
</div>
</div>
</div>
<?php } ?>
<div class="tab-pane fade <?php if ($nu->getLevel($_SESSION['User']) != 1) echo 'in active' ?>" id="course">
<div class="media">
<img class="pull-left media-object" src="images/about-us/mission.jpg" alt="Mission"> 
<div class="media-body">
<?php if ($nu->getCourseRegPercent($_SESSION['User']) < 100) {
?>
<p>To register the courses that you will take this session, click <a href="CourseRegistration.php">here</a></p>
<?php
}
else {
?>
<p>Your course registration has been completed.</p>
<?php
}
?>
</div>
</div>
</div>
<?php if ($nu->getLevel($_SESSION['User']) > 3) { ?>
<div class="tab-pane fade" id="waiver">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>If you have some outstanding courses and would like to apply for a waiver, you can do it by clicking <a href="WaiverForm.php">here</a></p>
</div>
</div>
</div>
<?php } ?>
<div class="tab-pane fade" id="results">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>Check your available results in any course by clicking <a href="Results.php">here</a></p>
</div>
</div>
</div>
<div class="tab-pane fade" id="complaints">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<?php
if (!$nu->checkForResultComplaint($_SESSION['User'])) {
?>
<p>For result related complaints, click <a href="ResultRelatedComplaint.php">here</a></p>
<?php
}
else {
?>
<p>You still have unresolved result related complaint in the system.</p>
<?php
}
?>
</div>
</div>
</div>
<div class="tab-pane fade" id="profile">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>To access your profile page or change your login password, click <a href="Profile.php">here</a></p>
</div>
</div>
</div>
<?php
}
else {
?>
<div class="tab-pane fade in active" id="payment">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>To access this portal, you will have to make payment of NGN 2,000. This enables you to carry out your registration and be able to check your results for a full academic year.</p>
<p>To make payment for the current academic year, you will make payment of NGN 2,000 to the following account</p>
<p>Account Name: JaySoft Global Resources</br>Account Number: 0314159017</br>Bank Name: First City Monument Bank (FCMB)</p>
<p>If you have already paid, click <a href="ProofOfPayment.php">here</a> to upload your proof of payment.</p>
<p>Your portal will be opened once we have confirmed your payment and you will get an SMS alert.</p>
</div>
</div>
</div>
<div class="tab-pane fade" id="profile">
<div class="media">
<img class="pull-left media-object" src="images/about-us/community.jpg" alt="Community"> 
<div class="media-body">
<p>To access your profile page or change your login password, click <a href="Profile.php">here</a></p>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
<div class="col-sm-6">
<h3>Your Registration Status</h3>
<div class="skill-bar">
<?php if ($nu->getLevel($_SESSION['User']) == 1) { ?>
<div class="skillbar clearfix " data-percent="<?php echo $nu->getSIFPercent($_SESSION['User'])?>%">
<div class="skillbar-title"><span>Student_Information_Form</span></div>
<div class="skillbar-bar"></div>
<div class="skill-bar-percent"><?php echo $nu->getSIFPercent($_SESSION['User'])?>% completed</div>
</div> <!-- End Skill Bar -->
<?php } ?>
<div class="skillbar clearfix " data-percent="<?php echo $nu->getCourseRegPercent($_SESSION['User'])?>%">
<div class="skillbar-title"><span>Course_Registration</span></div>
<div class="skillbar-bar"></div>
<div class="skill-bar-percent"><?php echo $nu->getCourseRegPercent($_SESSION['User'])?>% completed</div>
</div> <!-- End Skill Bar -->
<?php if ($nu->getLevel($_SESSION['User']) > 3) { ?>
<div class="skillbar clearfix " data-percent="15%">
<div class="skillbar-title"><span>Waiver_Registration</span></div>
<div class="skillbar-bar"></div>
<div class="skill-bar-percent">15% completed</div>
</div> <!-- End Skill Bar -->
<?php } ?></div>
</div>
<?php
}
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