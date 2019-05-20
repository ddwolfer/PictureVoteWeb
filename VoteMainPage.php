<?php  
	require("dbconnect_picinfo.php");

	$VoteName = $_POST['Name'];
	$flagContinue = 0;
	$UserVoteCount = 1;
	$MAXImage = 450;
?>

<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery-3.3.1.js"></script>
	<title></title>
</head>
<body>
<style type="text/css">
	#showPicLevel{
		width: 60%;
	}
	#LevelOne{
		width: 33%;

		float:left;
	}
	#LevelTwo{
		width: 33%;

		float:left;
	}
	#LevelThree{
		width: 33%;

		float:right;
	}
</style>
<!-- 先偵測有沒有填入暱稱 -->
<?php

	if (empty($VoteName)) {
		echo "你沒有填入暱稱 3秒後返回上一頁";
		?><meta http-equiv="refresh" content="3;url='index.php'"><?php
	}
	else{
		$flagContinue = 1;
	}
?>
<!-- 開始 -->
<center>
<?php
	if ($flagContinue == 1) {

		//連線
		$db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//錯誤訊息提醒

		//SQL語法
		$Userflag = $db->prepare("SELECT * FROM `UserInfo` WHERE `UserName` = '$VoteName'");
		$Userflag -> execute();
		$UserRow = $Userflag->fetch(); //取一行
		

		// //確認有沒有這個人
		if ($UserRow[0] == $VoteName) {
			echo "資料庫已存在的暱稱";
			$UserVoteCount = $UserRow[1]; //獲取已經投票的數量
		}else{
			echo "第一次投票的用戶 即將新增至資料庫";
			$UserInsert = $db->prepare("INSERT INTO `UserInfo` (`UserName`, `ImageVote`) VALUES ('$VoteName', '1')");
			$UserInsert->execute();
		}
		?>
		<!-- 換圖片JS -->
		<script type="text/javascript">
			//第一次先獲取目前哪一張圖片
			if (typeof(picNum) == 'undefined') {
				var picNum = <?php echo $UserVoteCount ?>;
			}
			//隨時待命的func
			$(document).ready(function(){
			    $(".btnVoteScore").click(function(){
			    	//做換圖片的動作
			    	if (picNum < 450) {
			    		picNum = picNum + 1 //下一張
			    	}
			    	var resultJPG = ''.concat("pic/",picNum,".jpg");
			        $("#nextPicJPG").attr("src",resultJPG); //更改圖片數據
			        // var resultJPEG = ''.concat("pic/",picNum,".jpeg");
			        // $("#nextPicJPEG").attr("src",resultJPEG); //更改圖片數據
			        // var resultPNG = ''.concat("pic/",picNum,".png");
			        // $("#nextPicPNG").attr("src",resultPNG); //更改圖片數據
			        document.getElementById("picNumberNow").innerHTML=picNum.toString(); //更改提示
			    });
			});
			//按下按鈕
			function ButtonCheck(btnClick) {
				//判斷按了哪一個按鈕
				var scoreClick = btnClick.name
				// alert("分數:"+scoreClick)
				//誰案的
				var voteUser = "<?php echo $VoteName ?>";
				// alert("評分者:"+voteUser)
				//利用ajax把評分跟暱稱傳到另一個php存到資料庫
			    $.ajax({
			        url: 'insertVoteScoreData.php',
			        cache: false,
			        dataType: 'html',
			        type: 'post',//可改 get 或 post
			        data: {
			           	scoreClick,
			           	voteUser
			        },
			        error: function(xhr) {
			            alert('request 發生錯誤');
			        },
			        success: function(response) {
			        	$('#ajaxRequestTest').html(response);
                		$('#ajaxRequestTest').fadeIn();
			        }
			    });
			    // alert("評分完成 下一張圖片")
			}
		</script>
		<!-- 換圖片 -->
		<?php
		echo "<br>";
		echo "你的暱稱是 $VoteName 這是第 <span id='picNumberNow'>$UserVoteCount</span> 張照片";		
	 	
	 	echo "<br>"; 
	 	
	 	?><div id="main" style="width: 60%;" ><?php
	 		// 顯示三種圖片(因為副檔名不一樣，先這樣弄之後改) START
		 	$ImageShowJPG = "pic/".strval($UserVoteCount).".jpg"; 
		 	echo "<img src='$ImageShowJPG' style='height: 400px;' id='nextPicJPG'>";
		 	// $ImageShowJPEG = "pic/".strval($UserVoteCount).".jpg";
		 	// echo "<img src='$ImageShowJPEG' style='width: 500px;' id='nextPicJPEG'>";
		 	// $ImageShowPNG = "pic/".strval($UserVoteCount).".png";
		 	// echo "<img src='$ImageShowPNG' style='width: 500px;' id='nextPicPNG'>";
		 	// 顯示三種圖片(因為副檔名不一樣，先這樣弄之後改) END
	 	?>		
	 		<br> <br> 
	 		<!-- 一堆按鈕START  -->
	 		<div id="voteScore" style="width: 80%;">
	 			<input id="btnVote" class="btnVoteScore" type="button" name="1" value="1" style="width: 50px; height: 30px; font-size: 20px;" onclick="ButtonCheck(this)">
	 			&nbsp &nbsp &nbsp
	 			<input id="btnVote" class="btnVoteScore" type="button" name="2" value="2" style="width: 50px; height: 30px; font-size: 20px;" onclick="ButtonCheck(this)">
	 			&nbsp &nbsp &nbsp
	 			<input id="btnVote" class="btnVoteScore" type="button" name="3" value="3" style="width: 50px; height: 30px; font-size: 20px;" onclick="ButtonCheck(this)">
	 			&nbsp &nbsp &nbsp
	 			<input id="btnVote" class="btnVoteScore" type="button" name="4" value="4" style="width: 50px; height: 30px; font-size: 20px;" onclick="ButtonCheck(this)">
	 			&nbsp &nbsp &nbsp
	 			<input id="btnVote" class="btnVoteScore" type="button" name="5" value="5" style="width: 50px; height: 30px; font-size: 20px;" onclick="ButtonCheck(this)">
	 			&nbsp &nbsp &nbsp
	 			
	 		</div>	
	 		<!-- 一堆按鈕END  -->
	 	</div><?php

	 	

	} 
 ?>
 
<br><br>

<div id="showPicLevel">
	<div id="LevelOne">
		一分範例
	</div>
	<div id="LevelTwo">
		三分範例
	</div>
	<div id="LevelThree">
		五分範例
	</div>
</div>
<div id="showPicLevel">
	<div id="LevelOne">
		<img src="pic/Level/1.jpg" style="width: 200px;">
	</div>
	<div id="LevelTwo">
		<img src="pic/Level/2.jpg" style="width: 200px;">
	</div>
	<div id="LevelThree">
		<img src="pic/Level/3.jpg" style="width: 200px;">
	</div>
</div>

 </center>
 <br>
<div id="ajaxRequestTest"></div>
<!-- 結束 -->
</body>
</html>