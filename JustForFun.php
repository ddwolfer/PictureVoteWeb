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
<script type="text/javascript" src="jquery-3.3.1.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    //按送出鍵動作
    $('#btn').click(function (){
        $.ajax({
            url: 'getThreeWord.php',
            cache: false,
            dataType: 'html',
            type: 'post',//可改 get 或 post
            data: {
            },
            error: function(xhr) {
                alert('request 發生錯誤');
            },
            success: function(response) {
                $('#result_word').html(response);
                $('#result_word').fadeIn();
            }
        });
    });
})
</script>
	隨機產生 形容詞+名詞+動詞
	<br>
	<input type="submit" value="START" id="btn">
	<div id="result_word"></div>	    

    <input type=button name="test" onclick='checkWho(this)' value='click me'>
    <input type=button name="test" onclick='checkWho(this)' value='click me'>
    <input type=button name="test" onclick="checkWho(this)" value='click me'>
    <script>
    function checkWho(it){
        o=document.all("test");
        for(i=0;i<o.length;i++){
            alert(it.name)
            if(it.sourceIndex==o[i].sourceIndex){
                alert("i am is the "+i+1);
            }
        }
    }
    </script>   
</body>
</html>