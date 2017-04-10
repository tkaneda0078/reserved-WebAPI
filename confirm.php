<?php
    // エラー内容を確認
    ini_set("display_errors", On);
    error_reporting(E_ALL);
    
    require '';
    
    session_start();
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約WebAPI</title>
</head>
<body>
    <h1>確認</h1>
    <form method="" action="">
	<table>
	    <tr>
		<th>ID：</th>
		<td>
		    <!--<input type="text" name="ID" id="id">-->
		</td>
	    </tr>
	    <tr>
		<th><span>※</span>名前：</th>
		<td>
		    <p><?php echo $_SESSION['name']; ?></p>
		</td>
	    </tr>
	    <tr>
		<th><span>※</span>メール：</th>
		<td>
		    <p><?php echo $_SESSION['email']; ?></p>
		</td>
	    </tr>
	</table>
	<input type="submit" value="登録">
    </form>
</body>
</html>
