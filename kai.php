<html Content-type: text/html; charset=utf-8>
<meta charset="UTF-8">
 
<?php

session_start();
if(isset($_SESSION['pian'])){
    $pian = $_SESSION['pian'];
    $output = shell_exec("C:\Users\Lenovo\AppData\Local\Programs\Python\Python37\python.exe kai.py $pian");
    $output=urldecode($output);
    echo $output;
    $_SESSION['back'] = $output;
    $unicode= "转换完成！";
    echo $unicode;
    $_SESSION['unicode'] = $unicode;
    header('Location: index.php');
exit;
}
?>