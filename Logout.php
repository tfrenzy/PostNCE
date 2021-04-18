<?php session_start();
if ($_SESSION['User'] != null) {session_destroy();}
header("Location: index.php");
?>