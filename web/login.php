<?php
if($_POST["save"]){
$tmpfname = tempnam("/var/www/sms/login", "login");
$name = $tmpfname . "." . "txt";
//echo $name; check 1
$pass=substr(str_shuffle(str_repeat("0123456789",5)),0,5); // and any other characters
$num = $_POST["contact"];
if(strlen($num)!=10)
{
echo "Please enter a valid number";
}
else{
//echo "hello"; check 2
//echo $num; check 3
//echo $pass; check 4
$handle = fopen($name, "w");
fwrite($handle, "$pass,$num" . "\n");
//fwrite($handle, "$mes,$num");
fclose($handle);
$username="root";
$password="bits";
$hostname="localhost";
$dbhandle = mysql_connect($hostname,$username,$password)
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("test",$dbhandle)
  or die("Could not select db");
$sql="INSERT INTO test(Contact, Pass)
VALUES
('$num','$pass')";
if(!mysql_query($sql,$dbhandle))
{
die('Error: '.mysql_error());
}
mysql_close($dbhandle);
echo "One more step ahead";
echo "Thanks for the registration";
include 'login.html';
}
unlink($tmpfname);
}
if($_POST["approve"]){

$host="localhost"; // Host name
$username="root"; // Mysql username
$password="bits"; // Mysql password
$db_name="test"; // Database name
$tbl_name="test"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

$num = $_POST["contact"];
$pass = $_POST["pass"];

// username and password sent from form
$myusername=$num;
$mypassword=$pass;
//echo $myusername;
//echo $mypassword;
// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE Contact='$myusername' and Pass='$mypassword'";
$result=mysql_query($sql);
$arr=array("Contact" => "$myusername" , "Pass" => "$mypassword");
// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
        //$rs_login=mysql_fetch_assoc($sql);
        //$uid=$rs_login['Contact'];
        echo "success";
	include 'sms.html';
}
else {
echo "Please verify the details";
}

//echo "success";
}
?>

