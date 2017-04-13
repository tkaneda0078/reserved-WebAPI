<?php

    session_start();
    
    require 'db.php';
    
    // データを登録後に予約レコードを発行
    $reserve_code = insert();
    
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
