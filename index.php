<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["buttonName"]) && $_POST["buttonName"] == "确"){
		$inputText = $_POST["inputText"];
		file_put_contents("wait.txt", $inputText);
	}}
	if(isset($_POST['金'])){
	header("Location: metal.php");
	exit;
	} elseif(isset($_POST['木'])){
	header("Location: wood.php");
	exit;
	} elseif(isset($_POST['水'])){
	header("Location: aqua.php");
	exit;
	}elseif(isset($_POST['火'])){
	header("Location: fire.php");
	exit;
	} elseif(isset($_POST['土'])){
	header("Location: dirt.php");
	exit;
	} elseif(isset($_POST['凯'])){
	$_SESSION['pian'] = $_POST['pian'];
	header("Location: kai.php");
	exit;
	} elseif(isset($_POST['U'])){
	$_SESSION['bu'] = $_POST['bu'];
	$checkboxState = isset($_POST['checkbox_value1']) ? 'true':'false';
	$_SESSION['checkbox_value1'] = $checkboxState;
	header("Location: UU.php");
	exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>偏旁部首文字转换器以及一些其他玩意</title>
	<style type="text/css">
     @font-face {
        font-family: "Font1";
        src: url("TH-Tshyn-P0.ttf");
    }
    @font-face {
        font-family: "Font2";
        src: url("TH-Tshyn-P1.ttf");
    }
    @font-face {
        font-family: "Font3";
        src: url("TH-Tshyn-P2.ttf");
    }
    @font-face {
        font-family: "Font4";
        src: url("TH-Tshyn-P16.ttf");
    }
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		body{
			display: flex;
			position: absolute;
			left: 0;
			top: 0;
			right: 0;
			bottom: 0;
			background-color: #f2f2f2;
      font-family: Arial,"Font1", "Font2","Font3", "Font4", sans-serif;
		}
    button {
      display: inline-block;
      margin-right: 10px;
      padding: 10px 20px;
      font-size: 13px;
      background-color: #00cc99;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    } 
	.tip {
        display: none;
    }
	.checkbox-container {  
        display: inline-block;  
        position: relative;
        transform: scale(1.5); 
        margin: 5px;
    }  
	</style>
	<script>
    var tips = {
        "输": "在此输入文字，要换行请手动输入&lt;br/&gt<br/>使用偏旁部首转换请输入基础区汉字，<br/>使用凯撒密码请输入一个有效的Unicode字符，<br/>使用UU加密建议不要输入字母数字等字符，可能导致加密轻微错乱。",
        "确": "将输入框的内容导入，<br/>然后按下下面的按钮。",
        "金": "钅字旁：将原文字添加“钅”或“金”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "木": "木字旁：将原文字添加“木”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "水": "氵字旁：将原文字添加“氵”或“水”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "火": "火字旁：将原文字添加“火”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "土": "土字旁：将原文字添加“土”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "F": "不在转换表的字符，<br/>这类字符没有通过转换表，直接进行输出。",
		"凯": "凯撒密码unicode版，将原有的字符的unicode向前或向后移动。超出范围会报错。",
		"偏": "凯撒密码的偏移量，<br/>正数为向前，负数为向后，<br/>比如hallo,world会变成ibmmp-xpsme。",
		"U": "将字符从Urlcode通过奇妙算法强行加密为Unicode文本，简称UU加密。<br/>不包解密代码，如需解密请自行写代码。<br/>bug很多，不打算修。<br/>遇到urlcode原样输出的字符会跳过，如果跳过字符不是4的倍数可能会导致加密错乱<br/>urlcode为2的倍数，如果不是4的倍数会用加密填充字符填充。<br/>本质上是转为4位16进制数，因此只会涉及第一平面（U+0000~U+FFFF）。",
		"补": "用于非4的倍数转换Unicode第一平面时的补足字符，必须是一个16进制数字。<br/>请输入0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f。",
		"是":"分别显示urlcode转换、移除百分号%、增加unicode<b>\\u</b>和分隔符<b>-</b>的内容，<br/>文本较长时慎用。"
    };

    function show(button) {
        var tipId = "tip" + button.id.slice(-4);
        var tip = document.getElementById(tipId);
        tip.innerHTML = tips[button.id];
        tip.style.display = "block";
    }

    function hide(button) {
        var tipId = "tip" + button.id.slice(-4);
        var tip = document.getElementById(tipId);
        tip.style.display = "none";
    }
</script>
</head>
<body>
<div style="display: flex;flex-direction: column;width: 100%;">
	<div style="height: 80px;background-color: #00cc99;color:white;text-align:center;padding: 20px; "><h1>偏旁部首文字转换器</h1><h3>以及一些其他玩意</h3></div>
	<div style="flex-grow: 1;">
		<div style="display: flex;flex-direction: row;width: 100%;height:100%;">
			<div style="width: 25%;background-color: #f2f2f2;;">
				<table style="width:100%;height:100%;border:none;">
					<tr>
						<td>
							<div style="background-color: #f7f7a2;width: 300px;height: 215px;margin: 0 auto;">
                <div style="background-color:#00cc99; padding: 3px; text-align:center;">提示：</div> 
				<div class="tip" id="tip输"></div>
					<div class="tip" id="tip确"></div>
					<div class="tip" id="tip金"></div>
					<div class="tip" id="tip木"></div>
					<div class="tip" id="tip水"></div>
					<div class="tip" id="tip火"></div>
					<div class="tip" id="tip土"></div>
					<div class="tip" id="tip凯"></div>
					<div class="tip" id="tip偏"></div>
					<div class="tip" id="tipU"></div>
					<div class="tip" id="tip补"></div>
					<div class="tip" id="tip是"></div>
							</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div style="flex-grow: 1;background-color:  #f2f2f2;text-align:center;margin: 0 auto;padding:20px;">
				<div id="" style="height: 190px;background: white;padding:20px;">
					<form method="post" >
						<input type="text" id="输" name="inputText" placeholder="输入文字" onmouseover="show(this)" onmouseout="hide(this)" style=" width: 80%;padding: 10px; font-size: 16px; border-radius: 5px 0 0 5px;border: 1px solid #ccc;">
						<button type="submit" style="border-radius: 0 5px 5px 0; margin-left: -4px;" id="确" value="确" name="buttonName" onmouseover="show(this)" onmouseout="hide(this)">确认</button>
						<br><br>
						<button type="submit" id="金" name="金" onmouseover="show(this)" onmouseout="hide(this)">转换为钅字旁</button>
						<button type="submit" id="木" name="木" onmouseover="show(this)" onmouseout="hide(this)">转换为木字旁</button>
						<button type="submit" id="水" name="水" onmouseover="show(this)" onmouseout="hide(this)">转换为氵字旁</button>
						<button type="submit" id="火" name="火" onmouseover="show(this)" onmouseout="hide(this)">转换为火字旁</button>
						<button type="submit" id="土" name="土" onmouseover="show(this)" onmouseout="hide(this)">转换为土字旁</button><br/><br/>
						<button type="submit" id="凯" name="凯" onmouseover="show(this)" onmouseout="hide(this)">凯撒密码unicode加密</button>
						凯撒密码偏移量：<input type="number" id="偏" name="pian" value="0" onmouseover="show(this)" onmouseout="hide(this)" style="width: 60px;height:30px; border: 3px solid #00cc99;padding: 10px;font-size: 16px;"><br/>
						<button type="submit" name="U" id="U" onmouseover="show(this)" onmouseout="hide(this)">UU加密（不包解密）</button>
						加密填充字符：<input type="text" id="补" name="bu" value="0" onmouseover="show(this)" onmouseout="hide(this)" maxlength="1" pattern="^[0-9A-Fa-f]+$" title="请输入有效的16进制数" style="width: 60px;height:30px; border: 3px solid #00cc99;padding: 10px;font-size: 16px;">
						启用加密过程显示：&nbsp;
						<input type="checkbox" id="是" name="checkbox_value1" onmouseover="show(this)" onmouseout="hide(this)" checked class="checkbox-container">
					</form>  
				</div>
				<br/><br/><div id="" style="height: 400px;width:49%;background: #f7f7a2;float:left;overflow:auto;">
				<div style="color:blue;position: sticky;top:0;background:#00cc99;">转换原文</div>
					<?php
					$basic = "wait.txt";
					$basic_out = file_get_contents($basic);
					echo $basic_out;
					?>
				</div>
				
				<div id="" style="height: 400px;width:49%;background: #f7f7a2;float:right;overflow:auto;">
				<div style="color:blue;position: sticky;top:0;;background:#00cc99;">转换结果</div>
					<?php
					$back = $_SESSION['back'];
					echo $back;
					?>
				</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				<div id="" style="height:55px;width:810px;background-color: #f7f7a2;text-align:center;margin: 0 auto;">
					<p style="color:blue;background:#00cc99;">未能转换的内容部分</p>
					 <?php
					$dis = "dis.txt";
					$dis_out = file_get_contents($dis);
					echo $dis_out;
					?>
				</div>
			</div>
			<div style="width: 25%;background-color: #f2f2f2;">
				<table style="width:100%;height:100%;border:none;">
					<tr>
						<td>
              <div style="background-color: #f7f7a2;width: 300px;height: 215px;margin: 0 auto;">
              <div style='background-color:#00cc99; padding: 3px; text-align:center;'>解析结果</div> 
				<?php
				$unicodeback = $_SESSION['unicode'];
				echo $unicodeback;
				?>
							</div>
						</td>
					</tr>
				</table>				
			</div>
		</div>
	</div>
</div>
</body>
</html>
