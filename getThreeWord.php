<?php  
	$hostname = "localhost"; 
	$username = "id6646993_ddwolf"; 
	$password = "123456";
	$db_name = "id6646993_random_chinese_word";
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

	/*形容詞 START*/
	$count=$db->prepare("select count(*) from Random_ADJective");
	$count->execute();
	$number=$count->fetchColumn(); //取得欄位1 的值  (也就是count(*)) 

	$random_id = rand(1,$number);

	$sql="Select * from Random_ADJective where ID = $random_id";
	$result=$db->query($sql);    

	while($row=$result->fetch(PDO::FETCH_NUM)){    
	    echo $row[1];  
	    echo "的";
	    echo "<br>"; 
	}
	/*形容詞 END*/

	/*名詞 START*/
	$count=$db->prepare("select count(*) from Random_Noun");
	$count->execute();
	$number=$count->fetchColumn(); //取得欄位1 的值  (也就是count(*)) 

	$random_id = rand(1,$number);

	$sql="Select * from Random_Noun where ID = $random_id";
	$result=$db->query($sql);    

	while($row=$result->fetch(PDO::FETCH_NUM)){    
	    echo $row[1];  
	    echo "<br>"; 
	}
	/*名詞 END*/

	/*動詞 START*/
	$count=$db->prepare("select count(*) from Random_Verb");
	$count->execute();
	$number=$count->fetchColumn(); //取得欄位1 的值  (也就是count(*)) 

	$random_id = rand(1,$number);

	$sql="Select * from Random_Verb where ID = $random_id";
	$result=$db->query($sql);    

	while($row=$result->fetch(PDO::FETCH_NUM)){    
	    echo $row[1];  
	    echo "<br>"; 
	}
	/*動詞 END*/
 ?>


</body>
</html>