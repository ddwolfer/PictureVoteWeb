<?php  
	require("dbconnect_picinfo.php");
	$dbsearch = "SELECT * FROM `pictureInfo`";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
</head>
<body>

<center>
	案欄位可以排序
<?php
	//連線
	$db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//錯誤訊息提醒

	$getDataframe = $db->prepare($dbsearch);
	$getDataframe->execute();
	$Dataframe = $getDataframe->fetchAll(PDO::FETCH_ASSOC);
	echo $SortID;
	?><table border="1" id="myTable" class="tablesorter"><?php
		echo "<thead>";
		echo "<tr>";
			echo "<td>圖片(ID)</td>";
			echo "<td>投票人數</td>";
			echo "<td>總計分數</td>";
			echo "<td>平均分數</td>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
	for ($i=0; $i < count($Dataframe); $i++) { 
		echo "<tr>";
			echo "<td>";
				$ImageShowJPG = "pic/".$Dataframe[$i]['ID'].".jpg";
				echo "<img src='$ImageShowJPG' style='height: 100px;' id='nextPicJPG'>";
				// echo $Dataframe[$i]['ID'];
			echo "</td>";
			echo "<td>";
				echo $Dataframe[$i]['scoreCount'];
			echo "</td>";
			echo "<td>";
				echo $Dataframe[$i]['scoreTotal'];
			echo "</td>";
			echo "<td>";
				echo $Dataframe[$i]['scoreAvg'];
			echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	?></table><?php

?>
<script type="text/javascript">
$(function () {
    // widgets: ['zebra'] 這個參數，能對表格的奇偶數列作分色處理
    $("#myTable").tablesorter({widgets: ['zebra']});
 
});
</script>
	
</center>
</body>
</html>