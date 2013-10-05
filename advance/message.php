<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

$securimage = new Securimage();

$tmpfname = tempnam("/var/www/sms/working", "");
$name = $tmpfname . "." . "txt";
echo $name;
if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue
  // or you can use the following code if there is no validation or you do not know how
  echo "The security code entered was incorrect.<br /><br />";
  echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
  exit;
}
$from=$_SESSION['number'];
$num = $_POST["contact"];
$mes = $_POST["message"];
echo "hello";
//chmod($name, 0777);
$handle = fopen($name, "w");
//$mes = "$_POST[message],";
//$num = "$_POST[contact]";
fwrite($handle, "$from;$mes,$num" . "\n");
//fwrite($handle, "$mes,$num");
fclose($handle);
unlink($tmpfname);
?>



