<?php
    // エラー内容を確認
    ini_set("display_errors", On);
    error_reporting(E_ALL);
    
    session_start();
    
    require 'validation.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {	

        $error_msg = array();

        $name  = $_POST['name'];
        $email = $_POST['email'];

        $val = new Validation();
        foreach ($_POST as $key => $value) {
            $error_msg[$key] = $val->isNull($value);
        }
        $error_msg[] = $val->isLength($name);
        $error_msg[] = $val->isMailaddress($email);

        if ($error_msg == true) {
            $_SESSION['name']  = $name;
            $_SESSION['email'] = $email;

            header('location:confirm.php');
            exit();
        }
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
    <p><span>※</span>は必須項目です。</p>
    <form method="POST" action="">
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
