<?php  
	$hostname = "localhost"; 
	$username = "id6646993_dwolf"; 
	$password = "123456";
	$db_name = "id6646993_iosfcuscore";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼

	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//錯誤訊息提醒 

	// for ($i=1; $i < 451 ; $i++) { 
	// 	$count=$db->prepare(  "INSERT INTO `pictureInfo` (`ID`, `scoreCount`, `scoreTotal`, `scoreAvg`, `lastUpdateTime`) VALUES ($i, '0', '0', '0', current_timestamp())"   );
	// 	$count->execute();
	// }
	
	// $count=$db->prepare(  "DELETE FROM `UserInfo` where `UserName`='123'"   );
	// $count->execute();
	// $count=$db->prepare(  "DELETE FROM `UserInfo` where `UserName`='55'"   );
	// $count->execute();
	// $count=$db->prepare(  "DELETE FROM `UserInfo` where `UserName`='66'"   );
	// $count->execute();
?>
成功
</body>
</html>