<?php 
//資料庫連線
$hostname = "localhost"; 
$username = "id6646993_dwolf"; 
$password = "123456";
$db_name = "id6646993_iosfcuscore";
//連線
$db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//錯誤訊息提醒

//先設定內容為空的變數
$get_or_post = '';//get 或 post 方式
$err		='';//發生錯誤時的記錄內容
//接收資料 START
if($_POST){
	$get_or_post = 'POST';
	$ImageScore = $_POST['scoreClick'];
	$UserName = $_POST['voteUser'];
	
}elseif($_GET){
	$get_or_post = 'GET';
	$ImageScore = $_GET['scoreClick'];
	$UserName = $_GET['voteUser'];
}
else{
	$err = '未知的資料傳遞方式<br />';
}
//接收資料 END

if ($err == "") {
	//SQL語法
	$UserDbData = $db->prepare("SELECT * FROM `UserInfo` WHERE `UserName` = '$UserName'");
	$UserDbData -> execute();
	$RowData = $UserDbData->fetch(); //取一行

	//測試用 START
	echo "以下是測試用的回傳字串";
	echo "<br傳遞成功";
	echo "<br> 分數為:";
	echo $ImageScore;
	echo "<br> 評分者為:";
	echo $UserName;
	echo "<br> 目前評分數量為:";
	echo $RowData[1];
	//測試用 END

	//評分數量+1
	$RowData[1] = $RowData[1] + 1 ;

	//更新評分數量 START
	$updateVoteCount = $db->prepare("UPDATE `UserInfo` SET `ImageVote` = '$RowData[1]' WHERE `UserName` = '$UserName'");
	$updateVoteCount->execute();
	echo "<br>更新評分數量完畢";
	//更新評分數量 END

	//紀錄評分資訊 START
	$pictureID = $RowData[1]-1;
	$insertScoreDetail = $db->prepare(" INSERT INTO `ScoreUser` (`Name`, `picID`, `score`, `time`) VALUES ('$UserName', '$pictureID', '$ImageScore', current_timestamp()) ");
	$insertScoreDetail -> execute();
	echo "<br>紀錄評分資訊完畢";
	//紀錄評分資訊 END

	//圖片總分、平均更新 START
	//先拿資料
	$getImageScoreData = $db->prepare(" SELECT * FROM `pictureInfo` WHERE `ID` = '$pictureID' ");
	$getImageScoreData->execute();
	$DataRow = $getImageScoreData->fetch(); //取一行
	//設定要更新的資料變數
	$updateCount = $DataRow[1]+1;
	$updateTotal = $DataRow[2]+$ImageScore;
	$updateAvg = $updateTotal/$updateCount;

	$updateImageScore = $db->prepare(" UPDATE `pictureInfo` SET `scoreCount` = '$updateCount',`scoreTotal` = '$updateTotal',`scoreAvg` = '$updateAvg' WHERE `ID` = '$pictureID' ");
	$updateImageScore->execute();
	echo "<br>圖片總分、平均更新完畢";
	//圖片總分、平均更新 END
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>	</title>
</head>
<body>

</body>
</html>