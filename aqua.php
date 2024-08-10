<html Content-type: text/html; charset=utf-8>
<meta charset="UTF-8">
 
<?php
session_start();
$output="". shell_exec("C:\Users\Lenovo\AppData\Local\Programs\Python\Python37\python.exe aqua.py");
$output=urldecode($output);
echo $output;
$_SESSION['back'] = $output;
header('Location: unicode.php');
exit;
?>