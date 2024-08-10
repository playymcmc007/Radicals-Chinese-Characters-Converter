<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["buttonName"]) && $_POST["buttonName"] == "Q"){
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
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>偏旁部首文字转换器</title>
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
      font-size: 16px;
      background-color: #00cc99;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    } 
	.tip {
        display: none;
    }
	</style>
	<script>
    var tips = {
        "输入文字": "在此输入文字，要换行请手动输入&lt;br/&gt<br>记得删掉默认的“输入文字”四个字。",
        "Q": "将输入框的内容导入，<br/>然后按下下面的按钮。",
        "A": "钅字旁：将原文字添加“钅”或“金”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "B": "木字旁：将原文字添加“木”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "C": "氵字旁：将原文字添加“氵”或“水”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "D": "火字旁：将原文字添加“火”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "E": "土字旁：将原文字添加“土”的结构，<br/>无法转换的会保持原状，<br/>不在转换表内的字符会在下方显示。",
        "F": "不在转换表的字符，<br/>这类字符没有通过转换表，直接进行输出。"
    };

    function show(button) {
        var tipId = "tip" + button.value.slice(-4);
        var tip = document.getElementById(tipId);
        tip.innerHTML = tips[button.value];
        tip.style.display = "block";
    }

    function hide(button) {
        var tipId = "tip" + button.value.slice(-4);
        var tip = document.getElementById(tipId);
        tip.style.display = "none";
    }
</script>
</head>
<body>
<div style="display: flex;flex-direction: column;width: 100%;">
	<div style="height: 80px;background-color: #00cc99;color:white;text-align:center;padding: 20px; "><h1>偏旁部首文字转换器</h1></div>
	<div style="flex-grow: 1;">
		<div style="display: flex;flex-direction: row;width: 100%;height:100%;">
			<div style="width: 25%;background-color: #f2f2f2;;">
				<table style="width:100%;height:100%;border:none;">
					<tr>
						<td>
							<div style="background-color: #f7f7a2;width: 300px;height: 215px;margin: 0 auto;">
                <div style="background-color:#00cc99; padding: 3px; text-align:center;">提示：</div> 
				<div class="tip" id="tip输入文字"></div>
					<div class="tip" id="tipQ"></div>
					<div class="tip" id="tipA"></div>
					<div class="tip" id="tipB"></div>
					<div class="tip" id="tipC"></div>
					<div class="tip" id="tipD"></div>
					<div class="tip" id="tipE"></div>
							</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div style="flex-grow: 1;background-color:  #f2f2f2;text-align:center;margin: 0 auto;padding:20px;">
				<div id="" style="height: 150px;background: white;padding:20px;">
					<form method="post" >
						<input type="text" name="inputText" value="输入文字" placeholder="输入文字" onmouseover="show(this)" onmouseout="hide(this)" style=" width: 80%;padding: 10px; font-size: 16px; border-radius: 5px 0 0 5px;border: 1px solid #ccc;">
						<button type="submit" style="border-radius: 0 5px 5px 0; margin-left: -4px;" name="buttonName" value="Q" onmouseover="show(this)" onmouseout="hide(this)">确认</button>
						<br><br>
						<button type="submit" name="金" value="A" onmouseover="show(this)" onmouseout="hide(this)">转换为钅字旁</button>
						<button type="submit" name="木" value="B" onmouseover="show(this)" onmouseout="hide(this)">转换为木字旁</button>
						<button type="submit" name="水" value="C" onmouseover="show(this)" onmouseout="hide(this)">转换为氵字旁</button>
						<button type="submit" name="火" value="D" onmouseover="show(this)" onmouseout="hide(this)">转换为火字旁</button>
						<button type="submit" name="土" value="E" onmouseover="show(this)" onmouseout="hide(this)">转换为土字旁</button>
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
              <div style='background-color:#00cc99; padding: 3px; text-align:center;'>unicode解析结果</div> 
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