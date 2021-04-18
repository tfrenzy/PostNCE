<?php
session_start();
if (isset($_POST['submit'])) {
include("Connect.php");
$username = $_POST['email'];
$password = $_POST['password'];
$nu = new Connect();
$nu->check_proper_login($username, $password);
}
?>