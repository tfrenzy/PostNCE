<?php
class Connect {
/*
public $location = "http://uniportpostncesandwich.com/";
protected $local_location = "/home/newdlqqi";
protected $host = "localhost";
protected $username = "newdlqqi_user";
protected $password = "Okesinachi123";
protected $database = "newdlqqi_donation";
protected $FILEREPOSITORY = "excel";
*/

public $location = "http://localhost/PostNCE/";
protected $local_location = "";
protected $host = "localhost";
protected $username = "root";
protected $password = "red";
protected $database = "sandwich_db";
protected $FILEREPOSITORY = "screenshot";
protected $EXCEL_PATH = "Classes/PHPExcel/";

public function __construct () {
$this->connect_to_db();
}

function getGrade($mark) {
if ($mark < 40) return 'F';
else if (($mark >= 39)&&($mark < 45)) return 'E';
else if (($mark >= 45)&&($mark < 50)) return 'D';
else if (($mark >= 50)&&($mark < 60)) return 'C';
else if (($mark >= 60)&&($mark < 70)) return 'B';
else return 'A';
}

function readExcel($excel, $matnostart, $scorestart, $coursecode, $coursetitle) {
$excel = $this->sanitize_username($excel);
$matnostart = $this->sanitize_username($matnostart);
$scorestart = $this->sanitize_username($scorestart);
$coursetitle = $this->sanitize_username($coursetitle);
$coursecode = $this->sanitize_username($coursecode);
include("Classes/PHPExcel/IOFactory.php");
try {
$inputFileType = PHPExcel_IOFactory::identify($excel);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($excel);
$sheetData = $objPHPExcel->getActiveSheet();
for ($i = 0; $i <= 300; $i++) {
$a = substr($matnostart, 0, 1);
$b = substr($matnostart, 1, count($matnostart));
$cellData = $sheetData->getCell($a.($b+$i))->getValue();
$a_ = substr($scorestart, 0, 1);
$b_ = substr($scorestart, 1, count($scorestart));
$cellData_ = $sheetData->getCell($a_.($b_+$i))->getValue();
if ((count($cellData) > 0)&&(count($cellData_) > 0)) {
$grade = $this->getGrade($cellData_);
$sql_ = "SELECT * FROM `results` WHERE `MatNumber` = '$cellData' AND `Mark` = '$cellData_' AND `CourseCode` = 'ENG203.1'";
$query_ = mysql_query($sql_);
if (mysql_num_rows($query_) == 0) {
$sql = "INSERT INTO `results` VALUES('$cellData', '$coursecode', '$coursetitle', '$cellData_', '$grade')";
$query = mysql_query($sql);
}
}
}
$sqli = "UPDATE `excel_files` SET `MatNoStartCell` = '$matnostart', `ScoresStartCell` = '$scorestart' WHERE `FileName` = '$excel'";
$queryi = mysql_query($sqli);
echo "<h3>Results successfully uploaded</h3>";
} catch(Exception $e) {
echo "Error loading file";
}
}

function uploadExcel($upload) {
try {
if (is_uploaded_file($upload['tmp_name'])) {
//if ($upload['filetype'] == ) {
//if (!file_exists($this->local_location."excel/".$upload['name'])) {
$sql = "SELECT * FROM `excel_files`";
$query = mysql_query($sql);
$rr = explode(".", $upload['name']);
$nwname = (mysql_num_rows($query)+1).".".$rr[count($rr)-1];
$result = move_uploaded_file($upload['tmp_name'], $this->local_location."excel/".$nwname);
if ($result == 1) {
$path = $this->local_location."excel/".$nwname;
$sql = "INSERT INTO `excel_files` VALUES('$path', 'No', 'No')";
$query = mysql_query($sql);
echo "<h3>File successfully uploaded.</h3>";
return $this->local_location."excel/".$nwname;
}
else {echo "<h3>There was a problem uploading the file.</h3>";return null;}
return null;
}
//}
else {
echo "<h3>Problem with file upload. Please try again.</h3>";return false;
}
}
catch (Exception $e) {
echo "<h3>Problems with upload.Try again later.</h3>";
return false;
}
return true;
}

function offersCourse($user, $coursecode) {
$user = $this->sanitize_email($user);
$coursecode = $this->sanitize_username($coursecode);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user' AND `CourseCode` = '$coursecode'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) return true;
else return false;
}

function getMatNo($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `registered` WHERE `Email` = '$user'";
$query = mysql_query($sql);
$matno = mysql_result($query, 0, "MatNumber");
if (count_chars($matno) == 0) return null;
else return $matno;
}

function checkResult($user, $coursecode) {
$user = $this->sanitize_email($user);
$coursecode = $this->sanitize_username($coursecode);
$matno = $this->getMatNo($user);
$sql = "SELECT * FROM `results` WHERE `MatNumber` = '$matno' AND `CourseCode` = '$coursecode'";
$query = mysql_query($sql);
if (mysql_num_rows($query) == 0) echo "<h3>Result unavailable</h3>";
else {
echo "<h3>Score: ".mysql_result($query, 0, "Mark")."</br>Grade: ".mysql_result($query, 0, "Grade")."</h3>";
}
}

function listMyCourses($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `lecturecourses` WHERE `User` = '$user'";
$query = mysql_query($sql);
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
echo "<option>".mysql_result($query, $i, "CourseCode")."</option>";
}
}

function listMyRegisteredCourses($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user'";
$query = mysql_query($sql);
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
echo "<option>".mysql_result($query, $i, "CourseCode")."</option>";
}
}

function getCourseTitle($coursecode) {
$coursecode = $this->sanitize_username($coursecode);
$sql = "SELECT * FROM `lecturecourses` WHERE `CourseCode` = '$coursecode'";
$query = mysql_query($sql);
return mysql_result($query, 0, "CourseTitle");
}

function registerCourse($user, $coursecode, $coursetitle, $yrofstudy) {
$user = $this->sanitize_email($user);
$coursecode = $this->sanitize_username($coursecode);
$coursetitle = $this->sanitize_username($coursetitle);
$yrofstudy = $this->sanitize_number($yrofstudy);
$sql = "SELECT * FROM `lecturecourses` WHERE `User` = '$user' AND `CourseCode` = '$coursecode' AND `CourseTitle` = '$coursetitle' AND `Level` = '$yrofstudy'";
$query = mysql_query($sql);
if (mysql_num_rows($query) == 0) {
$sql_ = "INSERT INTO `lecturecourses` VALUES('$user', '$coursecode', '$coursetitle', '$yrofstudy')";
$query_ = mysql_query($sql_);
echo "<h3>Course successfully registered";
return true;
}
else {
echo "<h3>Course has already been entered</h3>";
return false;
}
}

function displayStudentsOffering($coursecode) {
$coursecode = $this->sanitize_username($coursecode);
$sql = "SELECT * FROM `registered` WHERE `Status` = 'Confirmed'";
$query = mysql_query($sql);
echo "<table border=1>";
echo "<tr><td>Student Name</td><td>Matriculation Number</td><td>Phone</td><td>Email</td></tr>";
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
$email = mysql_result($query, $i, "Email");
if ($this->offersCourse($email, $coursecode)) {
echo "<tr><td>".mysql_result($query, $i, "FullName")."</td><td>".mysql_result($query, $i, "MatNumber")."</td><td>".mysql_result($query, $i, "Phone")."</td><td>".$email."</td></tr>";
}
}
echo "</table>";
}

function displayStudentList($year) {
$year = $this->sanitize_number($year);
$sql = "SELECT * FROM `registered` WHERE `Level` = '$year'";
$query = mysql_query($sql);
echo "<table border=1>";
echo "<tr><td>Student Name</td><td>Matriculation Number</td><td>Phone</td><td>Email</td></tr>";
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
echo "<tr><td>".mysql_result($query, $i, "FullName")."</td><td>".mysql_result($query, $i, "MatNumber")."</td><td>".mysql_result($query, $i, "Phone")."</td><td>".mysql_result($query, $i, "Email")."</td></tr>";
}
echo "</table>";
}

function uploadDocument($name) {
$name = $this->sanitize_username($name);
$file1 = $this->FILEREPOSITORY."/".$name.".jpg";
include("SimpleImage.php");
$img = new SimpleImage();
try {
if (is_uploaded_file($_FILES['fileField']['tmp_name'])) {
$img->load($_FILES['fileField']['tmp_name']);
$img->resize(500, 500);
$img->save($file1);
echo "Upload successful<br>";
}
else {
echo "Problem with file. Please upload another.<br>";
}
}
catch (Exception $e) {
echo "Problems with upload.Try again later.<br>";
return;
}
$uf = explode("_", $name);
$sql = "UPDATE `matched` SET `Status` = 'Awaiting Confirmation' WHERE `PersonID` = '$uf[0]' AND `ContributorID` = '$uf[1]'";
$query = mysql_query($sql);
echo("<script>location.href = '".$this->location."ProvideHelp.php';</script>");
}

function sanitize($old_string) {
$new_string = strip_tags($old_string);
if ((preg_match("/^[A-Za-z\s]+$/", $new_string))||(preg_match("/^[A-Za-z0-9\s]+$/", $new_string))||(@ereg("@", $new_string))||(@ereg("/", $new_string))||(@ereg("-", $new_string))) {
return $new_string;
}
else return null;
}

function sanitize_name($old_string) {
$new_string = strip_tags($old_string);
if (preg_match("/^[A-Za-z\s]+$/", $new_string)) {
return $new_string;
}
else return null;
}

function sanitize_address($old_string) {
$new_string = strip_tags($old_string);
if (preg_match("/^[A-Za-z0-9\s]+$/", $new_string)) {
return $new_string;
}
else return null;
}

function sanitize_username($old_string) {
$new_string = strip_tags($old_string);
if (preg_match("/^[A-Za-z0-9._\s ]/", $new_string)) {
return $new_string;
}
else return null;
}

function sanitize_email($old_string) {
$new_string = strip_tags($old_string);
$new_string = $this->sanitize($new_string);
if ((@ereg("@", $new_string))&&(@ereg(".", $new_string))) {
return $new_string;
}
else return null;
}

function sanitize_number($old_string) {
$new_string = strip_tags($old_string);
$new_string = preg_replace("/[^0-9]/", '', $new_string);
if (preg_match("/^[0-9\s]+$/", $new_string)) {
return $new_string;
}
else return null;
}

function connect_to_db() {
@mysql_connect($this->host, $this->username, $this->password)or die("Cannot connect to database");
mysql_select_db($this->database);
}


function check_admin($user) {
$user = $this->sanitize_email($user);
if ($user != null) {
$sql = "SELECT * FROM `registered` WHERE `Email` = '$user' AND `Status` = 'Administrator'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) return true;
else return false;		
}
else return false;
}

function check_lecturer($user) {
$user = $this->sanitize_email($user);
if ($user != null) {
$sql = "SELECT * FROM `registered` WHERE `Email` = '$user' AND `Status` = 'Lecturer'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) return true;
else return false;		
}
else return false;
}

function getLevel($email) {
$email = $this->sanitize_email($email);
$sql = "SELECT * FROM `registered` WHERE `Email` = '$email'";
$query = mysql_query($sql);
return mysql_result($query, 0, "Level");
}

function check_proper_login($email, $password) {
$email = $this->sanitize_email($email);
$password = $this->sanitize_username($password);
if (($email != null)&&($password != null)) {
if ($this->check_table($email, $password)) {
$_SESSION['User'] = $email;
$_SESSION['yrofstudy'] = $this->getLevel($email);
header("Location: ".$this->location.'Dashboard.php');
}
else {
header("Location: ".$this->location.'Login.php?e=Error');	
}
}
else {
header("Location: ".$this->location.'Login.php?e=Error2');	
}
}

function check_table($email, $password) {
$email = $this->sanitize_email($email);
$password = $this->sanitize_username($password);
if (($email != null)&&($password != null)) {
$sql = "SELECT * FROM `registered` WHERE `Email` = '$email'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) {
$existingHashFromDb = mysql_result($query, 0, "Password");
if (crypt($password, $email) == $existingHashFromDb) return true;
}
else return false;
}
else return false;
}

function setCorrectNavBar() {
if ($this->check_admin($_SESSION['User'])) include("navbar_admin.php");
else if ($this->check_lecturer($_SESSION['User'])) include("navbar_lecturer.php");
else include("navbar.php");
}

function register_admin($name, $email, $phone, $password) {
$name = $this->sanitize_name($name);
$email = $this->sanitize_email($email);
$phone = $this->sanitize_number($phone);
$password = $this->sanitize_username($password);	
if (($name != null)&&($email != null)&&($phone != null)&&($password != null)) {
if ($this->already_exists($name, "FullName")) {
echo "<h3>This name already exists</h3>";
return false;
}
else if ($this->already_exists($email, "Email")) {
echo "<h3>This Email already exists</h3>";
return false;
}
else if ($this->already_exists($phone, "Phone")) {
echo "<h3>This phone number already exists</h3>";
return false;
}
else {
$uf = explode("@", $email);
$hashToStoreInDb = crypt($password, $uf[0]);

$query = "INSERT INTO `registered` VALUES('$name', '$email', '$phone', 'None', '$hashToStoreInDb', '0', 'Administrator')";
$result = mysql_query($query);
echo "<h3>Registration Successful</h3></br>";
return true;
}
}
else echo "Problems encountered with your input";
return false;
}

function register($name, $phone, $matno, $email, $password, $yrofstudy) {
$name = $this->sanitize_name($name);
$email = $this->sanitize_email($email);
$phone = $this->sanitize_number($phone);
$matno = $this->sanitize_username($matno);
$password = $this->sanitize_username($password);
if (($name != null)&&($email != null)&&($phone != null)&&($password != null)) {
if ($this->already_exists($name, "FullName")) {
echo "<h3>This name already exists</h3>";
return false;
}
else if ($this->already_exists($email, "Email")) {
echo "<h3>This Email already exists</h3>";
return false;
}
else if ($this->already_exists($phone, "Phone")) {
echo "<h3>This phone number already exists</h3>";
return false;
}
/*
else if ($this->already_exists($matno, "MatNumber")) {
echo "<h3>This matriculation number already exists</h3>";
return false;
}
*/
else {
$uf = explode("@", $email);
$hashToStoreInDb = crypt($password, $uf[0]);

$query = "INSERT INTO `registered` VALUES('$name', '$email', '$phone', '$matno', '$hashToStoreInDb', '$yrofstudy', 'Unconfirmed')";
$result = mysql_query($query);
echo "<h3>Registration Successful</h3></br>";
return true;
}
}
else echo "Problems encountered with your input";
return false;
}

function already_exists($value, $column) {
$value = $this->sanitize($value);
$column = $this->sanitize($column);
$sql = "SELECT * FROM `registered` WHERE `$column` = '$value'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) return true;
else return false;
}

function getPersonPhone($email) {
$email = $this->sanitize_email($email);
$sql = "SELECT * FROM `registered` WHERE `Email` = '$email'";
$query = mysql_query($sql);
$phone = mysql_result($query, 0, "Phone");
return $phone;
}

function getProfile($user) {
$user = $this->sanitize_email($user);
if ($user != null) {
$sql = "SELECT * FROM `registered` WHERE `Email` = '$user'";
$result = mysql_query($sql);
$matno = mysql_result($result, 0, "MatNumber");
if ((count_chars($matno) == 0)||($matno == null)) $matno = "None";
if (mysql_num_rows($result) == 1) return mysql_result($result, 0, "FullName").":".mysql_result($result, 0, "Phone").":".$matno.":".mysql_result($result, 0, "Email").":Level ".mysql_result($result, 0, "Level")."00";
else return null;
}
}

function getUserStatus($user) {
$user = $this->sanitize_email($user);
if ($user != null) {
$sql = "SELECT * FROM `registered` WHERE `Email` = '$user'";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 1) return mysql_result($result, 0, "Status");
else return null;
}
}

function updateMatNo($user, $matno) {
$user = $this->sanitize_email($user);
$matno = $this->sanitize_username($matno);
if (($user != null)&&($matno != null)) {
$sql = "SELECT * FROM `registered` WHERE `MatNumber` = '$matno'";
$qry = mysql_query($sql);
if (mysql_num_rows($qry) > 0) {
echo "<h4>This matriculation number has already been used</h4>";
return false;
}
$query = "UPDATE `registered` SET `MatNumber` = '$matno' WHERE `Email` = '$user'";
$result = mysql_query($query);
echo "<h4>Matriculation Number Added!</h4>";
return true;
}
else echo "<h4>Problems encountered with password</h4></br> for $user and $password";
return false;
}

function editPassword($user, $password) {
$user = $this->sanitize_email($user);
$password = $this->sanitize_username($password);
if (($user != null)&&($password != null)) {
$uf = explode("@", $user);
$hashToStoreInDb = crypt($password, $uf[0]);

$query = "UPDATE `registered` SET `Password` = '$hashToStoreInDb' WHERE `Email` = '$user'";
$result = mysql_query($query);
echo "<h4>Password changed!!</h4>";
return true;
}
else echo "<h4>Problems encountered with password</h4></br> for $user and $password";
return false;
}

function getPersonName($email) {
$email = $this->sanitize_email($email);
$sql = "SELECT * FROM `registered` WHERE `Email` = '$email'";
$query = mysql_query($sql);
$name = mysql_result($query, 0, "FullName");
return $name;
}

function isConfirmed($email) {
$email = $this->sanitize_email($email);
$sql = "SELECT * FROM `registered` WHERE `Email` = '$email'";
$query = mysql_query($sql);
$status = mysql_result($query, 0, "Status");
if ($status == "Confirmed") return true;
else return false;
}

function formatt($number) {
$number = $this->sanitize_number($number);
return number_format($number , 0 , "." , "," );	
}

function displaySIF1($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif1` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "FullName");
$tru[1] = mysql_result($qery, 0, "FormerSurname");
$tru[2] = mysql_result($qery, 0, "RegistrationNumber");
$tru[3] = mysql_result($qery, 0, "PlaceOfOrigin");
$tru[4] = mysql_result($qery, 0, "MaritalStatus");
$tru[5] = mysql_result($qery, 0, "Religion");
return $tru;
}

function containsSIF1($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif1` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function editSIF1($user, $name, $maidenname, $regno, $placeoforigin, $maritalstatus, $religion) {
$user = $this->sanitize_email($user);
$name = $this->sanitize_username($name);
$maidenname = $this->sanitize($maidenname);
$regno = $this->sanitize($regno);
$placeoforigin = $this->sanitize($placeoforigin);
$maritalstatus = $this->sanitize($maritalstatus);
$religion = $this->sanitize($religion);
$sql = "DELETE FROM `sif1` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif1` VALUES('$user', '$name', '$maidenname', '$regno', '$placeoforigin', '$maritalstatus', '$religion')";
$query = mysql_query($sql2);
return true;
}

function enterSIF1($user, $name, $maidenname, $regno, $placeoforigin, $maritalstatus, $religion) {
$user = $this->sanitize_email($user);
$name = $this->sanitize_username($name);
$maidenname = $this->sanitize($maidenname);
$regno = $this->sanitize($regno);
$placeoforigin = $this->sanitize($placeoforigin);
$maritalstatus = $this->sanitize($maritalstatus);
$religion = $this->sanitize($religion);
$sql = "SELECT * FROM `sif1` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif1` VALUES('$user', '$name', '$maidenname', '$regno', '$placeoforigin', '$maritalstatus', '$religion')";
$query = mysql_query($sql2);
return true;
}
}

function editSIF2($user, $permhomeaddr, $contactaddr, $nextofkinname, $nextofkinaddr, $nextofkinrel, $nextofkinphone) {
$user = $this->sanitize_username($user);
$permhomeaddr = $this->sanitize_username($permhomeaddr);
$contactaddr = $this->sanitize_username($contactaddr);
$nextofkinname = $this->sanitize_username($nextofkinname);
$nextofkinaddr = $this->sanitize_username($nextofkinaddr);
$nextofkinrel = $this->sanitize_username($nextofkinrel);
$nextofkinphone = $this->sanitize_number($nextofkinphone);
$sql = "DELETE FROM `sif2` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif2` VALUES('$user',  '$permhomeaddr', '$contactaddr', '$nextofkinname', '$nextofkinaddr', '$nextofkinrel', '$nextofkinphone')";
$query = mysql_query($sql2);
return true;
}

function enterSIF2($user, $permhomeaddr, $contactaddr, $nextofkinname, $nextofkinaddr, $nextofkinrel, $nextofkinphone) {
$user = $this->sanitize_username($user);
$permhomeaddr = $this->sanitize_username($permhomeaddr);
$contactaddr = $this->sanitize_username($contactaddr);
$nextofkinname = $this->sanitize_username($nextofkinname);
$nextofkinaddr = $this->sanitize_username($nextofkinaddr);
$nextofkinrel = $this->sanitize_username($nextofkinrel);
$nextofkinphone = $this->sanitize_number($nextofkinphone);
$sql = "SELECT * FROM `sif2` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif2` VALUES('$user',  '$permhomeaddr', '$contactaddr', '$nextofkinname', '$nextofkinaddr', '$nextofkinrel', '$nextofkinphone')";
$query = mysql_query($sql2);
return true;
}
}

function displaySIF2($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif2` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "PermHomeAddr");
$tru[1] = mysql_result($qery, 0, "ContactAddr");
$tru[2] = mysql_result($qery, 0, "NextOfKinName");
$tru[3] = mysql_result($qery, 0, "NextOfKinAddress");
$tru[4] = mysql_result($qery, 0, "NextOfKinRelationship");
$tru[5] = mysql_result($qery, 0, "NextOfKinPhone");
return $tru;
}

function containsSIF2($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif2` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function editSIF3($user, $sponsorname, $sponsoraddress, $phonesponsor, $modeofentry, $prevuniversity, $programtype, $qualification) {
$user = $this->sanitize_email($user);
$sponsorname = $this->sanitize_username($sponsorname);
$sponsoraddress = $this->sanitize_username($sponsoraddress);
$phonesponsor = $this->sanitize_number($phonesponsor);
$modeofentry = $this->sanitize_username($modeofentry);
$prevuniversity = $this->sanitize_username($prevuniversity);
$programtype = $this->sanitize_username($programtype);
$qualification = $this->sanitize_username($qualification);
$sql = "DELETE FROM `sif3` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif3` VALUES('$user',  '$sponsorname', '$sponsoraddress', '$phonesponsor', '$modeofentry', '$prevuniversity', '$programtype', '$qualification')";
$query = mysql_query($sql2);	
return true;
}

function enterSIF3($user, $sponsorname, $sponsoraddress, $phonesponsor, $modeofentry, $prevuniversity, $programtype, $qualification) {
$user = $this->sanitize_email($user);
$sponsorname = $this->sanitize_username($sponsorname);
$sponsoraddress = $this->sanitize_username($sponsoraddress);
$phonesponsor = $this->sanitize_number($phonesponsor);
$modeofentry = $this->sanitize_username($modeofentry);
$prevuniversity = $this->sanitize_username($prevuniversity);
$programtype = $this->sanitize_username($programtype);
$qualification = $this->sanitize_username($qualification);
$sql = "SELECT * FROM `sif3` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif3` VALUES('$user',  '$sponsorname', '$sponsoraddress', '$phonesponsor', '$modeofentry', '$prevuniversity', '$programtype', '$qualification')";
$query = mysql_query($sql2);
return true;
}
}

function displaySIF3($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif3` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "NameSponsor");
$tru[1] = mysql_result($qery, 0, "SponsorAddr");
$tru[2] = mysql_result($qery, 0, "SponsorPhone");
$tru[3] = mysql_result($qery, 0, "ModeOfEntry");
$tru[4] = mysql_result($qery, 0, "PreviousUniversity");
$tru[5] = mysql_result($qery, 0, "ProgramType");
$tru[6] = mysql_result($qery, 0, "Qualification");
return $tru;
}

function containsSIF3($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif3` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function editSIF4($user, $institutionobtained, $dateobtained, $subjectfirstdegree, $yearofentry, $collegeofentry, $facultyofentry, $deptofentry) {
$user = $this->sanitize_email($user);
$institutionobtained = $this->sanitize_username($institutionobtained);
$dateobtained = $this->sanitize_username($dateobtained);
$subjectfirstdegree = $this->sanitize_username($subjectfirstdegree);
$yearofentry = $this->sanitize_number($yearofentry);
$collegeofentry = $this->sanitize_username($collegeofentry);
$facultyofentry = $this->sanitize_username($facultyofentry);
$deptofentry = $this->sanitize_username($deptofentry);
$sql = "DELETE FROM `sif4` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif4` VALUES('$user', '$institutionobtained', '$dateobtained', '$subjectfirstdegree', '$yearofentry', '$collegeofentry', '$facultyofentry', '$deptofentry')";
$query = mysql_query($sql2);
return true;
}

function enterSIF4($user, $institutionobtained, $dateobtained, $subjectfirstdegree, $yearofentry, $collegeofentry, $facultyofentry, $deptofentry) {
$user = $this->sanitize_email($user);
$institutionobtained = $this->sanitize_username($institutionobtained);
$dateobtained = $this->sanitize_username($dateobtained);
$subjectfirstdegree = $this->sanitize_username($subjectfirstdegree);
$yearofentry = $this->sanitize_number($yearofentry);
$collegeofentry = $this->sanitize_username($collegeofentry);
$facultyofentry = $this->sanitize_username($facultyofentry);
$deptofentry = $this->sanitize_username($deptofentry);
$sql = "SELECT * FROM `sif4` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif4` VALUES('$user', '$institutionobtained', '$dateobtained', '$subjectfirstdegree', '$yearofentry', '$collegeofentry', '$facultyofentry', '$deptofentry')";
$query = mysql_query($sql2);
return true;
}
}

function displaySIF4($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif4` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "InstitutionObtained");
$tru[1] = mysql_result($qery, 0, "DateObtained");
$tru[2] = mysql_result($qery, 0, "SubjectFirstDegree");
$tru[3] = mysql_result($qery, 0, "YearOfEntry");
$tru[4] = mysql_result($qery, 0, "CollegeOfEntry");
$tru[5] = mysql_result($qery, 0, "FacultyOfEntry");
$tru[6] = mysql_result($qery, 0, "DeptOfEntry");
return $tru;
}

function containsSIF4($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif4` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function editSIF5($user, $qualificationinview, $modeofstudy, $normalcourseduration, $extracurricular, $healthstatus, $disabletype, $medicationtype) {
$user = $this->sanitize_email($user);
$qualificationinview = $this->sanitize_username($qualificationinview);
$modeofstudy = $this->sanitize_username($modeofstudy);
$normalcourseduration = $this->sanitize_username($normalcourseduration);
$extracurricular = $this->sanitize_username($extracurricular);
$healthstatus = $this->sanitize_username($healthstatus);
$disabletype = $this->sanitize_username($disabletype);
$medicationtype = $this->sanitize_username($medicationtype);
$sql = "DELETE FROM `sif5` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif5` VALUES('$user', '$qualificationinview', '$modeofstudy', '$normalcourseduration', '$extracurricular', '$healthstatus', '$disabletype', '$medicationtype')";
$query = mysql_query($sql2);
return true;
}

function enterSIF5($user, $qualificationinview, $modeofstudy, $normalcourseduration, $extracurricular, $healthstatus, $disabletype, $medicationtype) {
$user = $this->sanitize_email($user);
$qualificationinview = $this->sanitize_username($qualificationinview);
$modeofstudy = $this->sanitize_username($modeofstudy);
$normalcourseduration = $this->sanitize_username($normalcourseduration);
$extracurricular = $this->sanitize_username($extracurricular);
$healthstatus = $this->sanitize_username($healthstatus);
$disabletype = $this->sanitize_username($disabletype);
$medicationtype = $this->sanitize_username($medicationtype);
$sql = "SELECT * FROM `sif5` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif5` VALUES('$user', '$qualificationinview', '$modeofstudy', '$normalcourseduration', '$extracurricular', '$healthstatus', '$disabletype', '$medicationtype')";
$query = mysql_query($sql2);
return true;
}
}

function displaySIF5($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif5` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "QualificationInView");
$tru[1] = mysql_result($qery, 0, "ModeOfStudy");
$tru[2] = mysql_result($qery, 0, "NormalCourseDuration");
$tru[3] = mysql_result($qery, 0, "Extracurricular");
$tru[4] = mysql_result($qery, 0, "HealthStatus");
$tru[5] = mysql_result($qery, 0, "DisableType");
$tru[6] = mysql_result($qery, 0, "MedicationType");
return $tru;
}

function containsSIF5($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif5` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function containsSIF6($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif6` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function editSIF7($user, $name, $college) {
$user = $this->sanitize_email($user);
$name = $this->sanitize_username($name);
$college = $this->sanitize_username($college);
$sql = "DELETE FROM `sif7` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$sql2 = "INSERT INTO `sif7` VALUES('$user', '$name', '$college')";
$query = mysql_query($sql2);
return true;
}

function enterSIF7($user, $name, $college) {
$user = $this->sanitize_email($user);
$name = $this->sanitize_username($name);
$college = $this->sanitize_username($college);
$sql = "SELECT * FROM `sif7` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Information already exists</p>";
return false;
}
else {
$sql2 = "INSERT INTO `sif7` VALUES('$user', '$name', '$college')";
$query = mysql_query($sql2);
return true;
}
}

function displaySIF7($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif7` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$tru[0] = mysql_result($qery, 0, "Name");
$tru[1] = mysql_result($qery, 0, "College");
return $tru;
}

function containsSIF7($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif7` WHERE `User` = '$user'";
$qery = mysql_query($sql);
if (mysql_num_rows($qery) > 0) return true;
else return false;
}

function getSIFPercent($user) {
$user = $this->sanitize_email($user);
$percent = 0;
if ($this->containsSIF1($user)) $percent += 1;
if ($this->containsSIF2($user)) $percent += 1;
if ($this->containsSIF3($user)) $percent += 1;
if ($this->containsSIF4($user)) $percent += 1;
if ($this->containsSIF5($user)) $percent += 1;
if ($this->containsSIF6($user)) $percent += 1;
if ($this->containsSIF7($user)) $percent += 1;
$percent = intval(($percent/7)*100);
return $percent;
}

function getCourseRegPercent($user) {
$user = $this->sanitize_email($user);
$level = $this->getLevel($user);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user' AND `YearOfStudy` = '$level'";
$query = mysql_query($sql);
$creditunit = 0;
for ($i=0; $i <= mysql_num_rows($query)-1; $i++) {
$creditunit = $creditunit + mysql_result($query, $i, "CreditUnit");
}
if ($creditunit < 22) {
return intval(($creditunit/24)*100);
}
else return 100;
}

function editSIF6($user, $subject, $examno, $examcenter, $examdate) {
$user = $this->sanitize_email($user);	
$subject = $this->sanitize_username($subject);	
$examno = $this->sanitize_username($examno);	
$examcenter = $this->sanitize_username($examcenter);	
$examdate = $this->sanitize_username($examdate);
$sqql = "SELECT * FROM `sif6` WHERE `User` = '$user' AND `Subject` = '$subject' AND `ExamNumber` = '$examno' AND `ExamCenter` = '$examcenter' AND `Date` = '$examdate'";
$qery = mysql_query($sqql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Subject already entered</p>";
}
else {
$sql = "INSERT INTO `sif6` VALUES('$user', '$subject', '$examno', '$examcenter', '$examdate')";
$query = mysql_query($sql);	
}
}

function enterSubject($user, $subject, $examno, $examcenter, $examdate) {
$user = $this->sanitize_email($user);	
$subject = $this->sanitize_username($subject);	
$examno = $this->sanitize_username($examno);	
$examcenter = $this->sanitize_username($examcenter);	
$examdate = $this->sanitize_username($examdate);
$sqql = "SELECT * FROM `sif6` WHERE `User` = '$user' AND `Subject` = '$subject' AND `ExamNumber` = '$examno' AND `ExamCenter` = '$examcenter' AND `Date` = '$examdate'";
$qery = mysql_query($sqql);
if (mysql_num_rows($qery) > 0) {
echo "<p>Subject already entered</p>";
}
else {
$sql = "INSERT INTO `sif6` VALUES('$user', '$subject', '$examno', '$examcenter', '$examdate')";
$query = mysql_query($sql);	
}
}

function loadSubjects($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif6` WHERE `User` = '$user'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) {
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
echo "<tr><td>".mysql_result($query, $i, "Subject")."</td><td>".mysql_result($query, $i, "Subject")."</td><td>".mysql_result($query, $i, "ExamNumber")."</td><td>".mysql_result($query, $i, "ExamCenter")."</td><td>".mysql_result($query, $i, "Date")."</td></tr>";
}
}	
}

function deleteAllSIF($user) {
$user = $this->sanitize_email($user);
$sql1 = "DELETE FROM `sif1` WHERE `User` = '$user'";
$query1 = mysql_query($sql1);
$sql2 = "DELETE FROM `sif2` WHERE `User` = '$user'";
$query2 = mysql_query($sql2);
$sql3 = "DELETE FROM `sif3` WHERE `User` = '$user'";
$query3 = mysql_query($sql3);
$sql4 = "DELETE FROM `sif4` WHERE `User` = '$user'";
$query4 = mysql_query($sql4);
$sql5 = "DELETE FROM `sif5` WHERE `User` = '$user'";
$query5 = mysql_query($sql5);
$sql6 = "DELETE FROM `sif6` WHERE `User` = '$user'";
$query6 = mysql_query($sql6);
$sql7 = "DELETE FROM `sif7` WHERE `User` = '$user'";
$query7 = mysql_query($sql7);
echo "<h3>All Information successfully deleted. You can select the Student Information form and fill it again</h3>";	
}

function enterResultComplaint($user, $matricno, $coursecode, $coursetitle, $dateattempted, $courselecturer) {
$user = $this->sanitize_email($user);
$matricno = $this->sanitize_username($matricno);
$coursecode = $this->sanitize_username($coursecode);
$coursetitle = $this->sanitize_username($coursetitle);
$courselecturer = $this->sanitize_username($courselecturer);
$dateattempted = $this->sanitize_username($dateattempted);
$sql_ = "SELECT * FROM `resultcomplaint` WHERE `User` = '$user'";
$query_ = mysql_query($sql_);
if (mysql_num_rows($query_) > 0) {
echo "<h3>This information has already been entered</h3>";
return false;
}
else {
$sql = "INSERT INTO `resultcomplaint` VALUES('$user', '$matricno', '$coursecode', '$coursetitle', '$dateattempted', '$courselecturer')";	
$query = mysql_query($sql);
return true;
}
}

function enterResultComplaint1($user, $wrongscore, $wrongaddtn, $missingassesscore, $missingexamscore, $noresult, $tworesults, $wrongmatno, $correctmatno, $wrongname, $correctname, $others, $others_) {
$user = $this->sanitize_email($user);
$wrongscore = $this->sanitize_username($wrongscore);
$wrongaddtn = $this->sanitize_username($wrongaddtn);
$missingassesscore = $this->sanitize_username($missingassesscore);
$missingexamscore = $this->sanitize_username($missingexamscore);
$noresult = $this->sanitize_username($noresult);
$tworesults = $this->sanitize_username($tworesults);
$wrongmatno = $this->sanitize_username($wrongmatno);
$correctmatno = $this->sanitize_username($correctmatno);
$wrongname = $this->sanitize_username($wrongname);
$correctname = $this->sanitize_username($correctname);
$others = $this->sanitize_username($others);
$others_ = $this->sanitize_username($others_);
$sql_ = "SELECT * FROM `resultcomplaint1` WHERE `User` = '$user'";
$query_ = mysql_query($sql_);
if (mysql_num_rows($query_) > 0) {
echo "<h3>This information has already been entered</h3>";
return false;
}
else {
$sql = "INSERT INTO `resultcomplaint1` VALUES('$user', '$wrongscore', '$wrongaddtn', '$missingassesscore', '$missingexamscore', '$noresult', '$tworesults', '$wrongmatno', '$correctmatno', '$wrongname', '$correctname', '$others', '$others_')";	
$query = mysql_query($sql);
return true;
}
}

function checkForResultComplaint($user) {
$user = $this->sanitize_email($user);
$sql_ = "SELECT * FROM `resultcomplaint1` WHERE `User` = '$user'";
$query_ = mysql_query($sql_);
if (mysql_num_rows($query_) > 0) return true;
else return false;
}

function enterWaiverApplication($user, $matno, $coursecode1, $coursetitle1, $dateattempt1, $coursecode2, $coursetitle2, $dateattempt2) {
$user = $this->sanitize_email($user);
$matno = $this->sanitize_username($matno);
$coursecode1 = $this->sanitize_username($coursecode1);
$coursecode2 = $this->sanitize_username($coursecode2);
$coursetitle1 = $this->sanitize_username($coursetitle1);
$coursetitle2 = $this->sanitize_username($coursetitle2);
$dateattempt1 = $this->sanitize_username($dateattempt1);
$dateattempt2 = $this->sanitize_username($dateattempt2);
$sql = "SELECT * FROM `waiverapplication` WHERE `User` = '$user'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) {
echo "<h3>Waiver Application already in system</h3>";	
}
else {
$sql1 = "INSERT INTO `waiverapplication` VALUES('$user', '$matno', '$coursecode1', '$coursetitle1', '$dateattempt1', '$coursecode2', '$coursetitle2', '$dateattempt2')";
$query1 = mysql_query($sql1);
echo "<h3>Waiver Application successfully entered into system</h3>";
}
}

function getTotalCreditUnits($user, $yrofstudy) {
$creditunits = 0;
$user = $this->sanitize_email($user);
$yrofstudy = $this->sanitize_username($yrofstudy);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user' AND `YearOfStudy` = '$yrofstudy'";
$query = mysql_query($sql);
for ($i = 0; $i <= mysql_num_rows($query)-1; $i++) {
$creditunits += mysql_result($query, $i, "CreditUnit");	
}
return $creditunits;
}

function enterCourse($user, $coursetitle, $coursecode, $creditunits, $yrofstudy) {
$user = $this->sanitize_email($user);
$coursecode = $this->sanitize_username($coursecode);
$coursetitle = $this->sanitize_username($coursetitle);
$creditunits = $this->sanitize_username($creditunits);
$yrofstudy = $this->sanitize_username($yrofstudy);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user' AND `CourseCode` = '$coursecode' AND `CourseTitle`= '$coursetitle' AND `CreditUnit`= '$creditunits' AND `YearOfStudy` = '$yrofstudy'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) {
echo "<h3>Course already in system</h3>";	
}
else if ($this->getTotalCreditUnits($user, $yrofstudy) > 24) {
echo "<h3>You can't enter any more courses</h3>";
}
else {
$sql1 = "INSERT INTO `registeredcourses` VALUES('$user', '$coursecode', '$coursetitle', '$creditunits', '$yrofstudy')";
$query1 = mysql_query($sql1);
echo "<h3>Course successfully entered into system</h3>";
}
}

function loadRegisteredCourses($user, $yrofstudy) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `registeredcourses` WHERE `User` = '$user' AND `YearOfStudy` = '$yrofstudy'";
$query = mysql_query($sql);
if (mysql_num_rows($query) > 0) {
for ($i =0; $i <= mysql_num_rows($query)-1; $i++) {
echo "<tr><td>".mysql_result($query, $i, "CourseCode")."</td><td>".mysql_result($query, $i, "CourseTitle")."</td><td>".mysql_result($query, $i, "CreditUnit")."</td></tr>";
}
}
}

function createSIFHTML($user) {
$user = $this->sanitize_email($user);
$sql = "SELECT * FROM `sif1` WHERE `User` = '$user'";
$qery = mysql_query($sql);
$html[0] = "<p>Full Name: ".mysql_result($qery, 0, "FullName")."</p><p>Former Surname: ".mysql_result($qery, 0, "FormerSurname")."</p><p>Registration Number: ".mysql_result($qery, 0, "RegistrationNumber")."</p><p>Place of Origin: ".mysql_result($qery, 0, "PlaceOfOrigin")."</p><p>Marital Status: ".mysql_result($qery, 0, "MaritalStatus")."</p><p>Religion: ".mysql_result($qery, 0, "Religion")."</p>";
$sql1 = "SELECT * FROM `sif2` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
$html[0] = $html[0]."<p>Permanent Home Address: ".mysql_result($qery1, 0, "PermHomeAddr")."</p><p>Contact Address: ".mysql_result($qery1, 0, "ContactAddr")."</p><p>Next Of Kin Name: ".mysql_result($qery1, 0, "NextOfKinName")."</p><p>Next Of Kin Address: ".mysql_result($qery1, 0, "NextOfKinAddress")."</p><p>Relationship to Next Of Kin: ".mysql_result($qery1, 0, "NextOfKinRelationship")."</p><p>Phone of Next Of Kin: ".mysql_result($qery1, 0, "NextOfKinPhone")."</p>";
$sql1 = "SELECT * FROM `sif3` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
$html[0] = $html[0]."<p>Sponsor Address: ".mysql_result($qery1, 0, "SponsorAddr")."</p><p>Sponsor Phone: ".mysql_result($qery1, 0, "SponsorPhone")."</p><p>Mode Of Entry: ".mysql_result($qery1, 0, "ModeOfEntry")."</p><p>Previous University: ".mysql_result($qery1, 0, "PreviousUniversity")."</p><p>Program Type: ".mysql_result($qery1, 0, "ProgramType")."</p><p>Highest Qualification: ".mysql_result($qery1, 0, "Qualification")."</p>";
$sql1 = "SELECT * FROM `sif4` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
$html[1] = "<p>Institution Obtained: ".mysql_result($qery1, 0, "InstitutionObtained")."</p><p>Date Obtained: ".mysql_result($qery1, 0, "DateObtained")."</p><p>Subject of First Degree: ".mysql_result($qery1, 0, "SubjectFirstDegree")."</p><p>Year Of Entry into present institution: ".mysql_result($qery1, 0, "YearOfEntry")."</p><p>College Of Entry: ".mysql_result($qery1, 0, "CollegeOfEntry")."</p><p>Faculty Of Entry: ".mysql_result($qery1, 0, "FacultyOfEntry")."</p><p>Department Of Entry: ".mysql_result($qery1, 0, "DeptOfEntry")."</p>";
$sql1 = "SELECT * FROM `sif5` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
$html[1] = $html[1]."<p>Qualification In View: ".mysql_result($qery1, 0, "QualificationInView")."</p><p>Mode Of Study: ".mysql_result($qery1, 0, "ModeOfStudy")."</p><p>Normal Course Duration: ".mysql_result($qery1, 0, "NormalCourseDuration")."</p><p>Extracurricular Activities: ".mysql_result($qery1, 0, "Extracurricular")."</p><p>Health Status: ".mysql_result($qery1, 0, "HealthStatus")."</p><p>Disability Type (if any): ".mysql_result($qery1, 0, "DisableType")."</p><p>Type of Medication needed (if any): ".mysql_result($qery1, 0, "MedicationType")."</p>";
$sql1 = "SELECT * FROM `sif6` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
for ($i = 0; $i <= mysql_num_rows($qery1)-1; $i++) {
$html[1] = $html[1]."<p>Subject: ".mysql_result($qery1, $i, "Subject")." Date Of Exam: ".mysql_result($qery1, $i, "Date")." Exam Number: ".mysql_result($qery1, $i, "ExamNumber")." Exam Center: ".mysql_result($qery1, $i, "ExamCenter")."</p>";
}
$sql1 = "SELECT * FROM `sif7` WHERE `User` = '$user'";
$qery1 = mysql_query($sql1);
$html[2] = "<p align=center>ATTESTATION</p>";
$html[2] = $html[2]."<p> I ".mysql_result($qery1, 0, "Name")." of the College/Faculty of ".mysql_result($qery1, 0, "College")." agree that my studentship be withdrawn if it is found
 that I have given false information in my registration forms. I solemnly and sincerely promise and declare that I will respect and be obedient to the 
 Vice Chancellor and other officers of the University, and that I will faithfully observe all regulations which may from time to time be issued for the good order and 
 governance of the University. I denounce membership of secret societies. I also solemnly promise to obey all Senate regulations on academic programmes and procedures.</p>";

return $html;
}

}
?>