<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<meta name="description" content="Creative One Page Parallax Template">
<meta name="keywords" content="Creative, Onepage, Parallax, HTML5, Bootstrap, Popular, custom, personal, portfolio" /> 
<meta name="author" content=""> 
<title>Profile</title> 
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
?>
<form id="contact-form" class="contact" name="contact-form" method="post" action="">
<?php
$check = false;
if (isset($_POST['submit'])) {
$password = $_POST['password'];
$confirm = $_POST['confirm'];
if (($password != null)&&($confirm != null)) {
if ($password == $confirm) $check = $nu->editPassword($_SESSION['User'], $password);
}
if (isset($_POST['matricno'])) {
$nu->updateMatNo($_SESSION['User'], $_POST['matricno']);
}
}
else if (!$check) {
$borke = $nu->getProfile($_SESSION['User']);
$brk = explode(":", $borke);
?>
<div class="form-group">
<input type="text" name="name" class="form-control" disabled="true" value="<?php echo $brk[0] ?>">
</div><p></p>
<div class="form-group">
<input type="number" name="phone" class="form-control" disabled="true" value="<?php echo $brk[1] ?>">
</div><p></p>
<div class="form-group">
<input type="text" name="matricno" class="form-control" <?php if ($brk[2] != "None") {?> disabled="true" value="<?php echo $brk[2] ?>" <?php } else {?> placeholder="Enter your Matriculation Number" <?php } ?>>
</div><p></p>
<div class="form-group">
<input type="email" name="email" class="form-control" disabled="true" value="<?php echo $brk[3] ?>">
</div>
<div class="form-group">
<input type="yrofstudy" name="password" class="form-control" disabled="true" value="<?php echo $brk[4] ?>">
</div>
<div class="form-group">
<input type="password" name="password" class="form-control" placeholder="Your Password">
</div> 
<div class="form-group">
<input type="password" name="confirm" class="form-control" placeholder="Confirm Your Password">
</div>
<div class="form-group">
<button type="submit" name="submit" class="btn btn-primary">Edit</button>
</div>
</form> 
<?php
}
else {echo "<h3>Password Mismatch</h3></br>";$check = false;}
}
else echo "<h3>You do not have permission to view this page. Your account may have expired or has not been confirmed.</br>Go back to <a href=index.php>Home Page</a>";
?>
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