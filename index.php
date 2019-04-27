<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<form method="POST" action="VoteMainPage.php"> 
		暱稱：
		<input type="text" name="Name">
		<br> <br> 
		<input type="submit" name="" value="去評分" style="width:240px;height:80px;font-size:30px;">
	</form> 

	<br>
	<input type="button" name="" value="看結果" style="width:240px;height:80px;font-size:30px;">
	顯示結果頁面還沒做
	<br> <br>
	<input type="button" value="放好玩的東西" onclick="location.href='JustForFun.php'" style="width:240px;height:80px;font-size:30px;">
	<br> <br>
	<form method="POST" action="InsertSQL.php">
		<input type="submit" name="" value="SQL新增" style="width:240px;height:80px;font-size:30px;">
	</form>
</center>
</body>
</html>


