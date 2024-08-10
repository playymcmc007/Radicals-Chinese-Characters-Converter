<html Content-type: text/html; charset=utf-8>
<meta charset="UTF-8">
 
<?php

session_start();
if(isset($_SESSION['bu'])){
    $bu = $_SESSION['bu'];
    $output = shell_exec("C:\Users\Lenovo\AppData\Local\Programs\Python\Python37\python.exe uu.py $bu");
    $output=urldecode($output);
    echo $output;
    $_SESSION['back'] = $output;
    $unicode= file_get_contents("text.txt");
    if(isset($_SESSION['checkbox_value1'])) {
        $checkboxState = $_SESSION['checkbox_value1'];
        if($checkboxState=='true'){
            echo $unicode;
            $_SESSION['unicode'] = $unicode;
        }
        else{
            $unicode="加密过程显示已关闭。";
            $_SESSION['unicode'] = $unicode;
        }
    }
    header('Location: index.php');
exit;
}
?>