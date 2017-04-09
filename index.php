<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約WebAPI</title>
</head>
<body>
    <h1>予約WebAPI</h1>
    <p><span class="red">※</span>は必須項目です。</p>
    <form method="POST" action="index.php">
    <table>
    <tr>
	<th>ID：</th>
	<td>
	    <input type="text" name="ID" id="id" required>
	</td>
    </tr>
    <tr>
	<th><span>※</span>名前：</th>
	<td>
	    <input type="text" name="name" id="name" autofocus required>
	</td>
    </tr>
    <tr>
	<th><span>※</span>メール：</th>
	<td>
	    <input type="email" name="email" id="email" required>
	</td>
    </tr>
    </table>
    <input type="submit" value="送信">
    </form>
</body>
</html>
