<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/api.php';

$api = new Api();

$name = $_SESSION['name'];
$email = $_SESSION['email'];

session_destroy();

// データを登録後に予約レコードを発行
$reserve_code = $api->insert($name, $email);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>予約WebAPI</title>
    </head>
    <body>
        <h1>登録完了</h1>
        <table>
            <tr>
                <th>予約コード：</th>
                <td>
                    <p><?php echo $reserve_code; ?></p>
                </td>
            </tr>
            <tr>
                <th>名前：</th>
                <td>
                    <p><?php echo $name; ?></p>
                </td>
            </tr>
            <tr>
                <th>メール：</th>
                <td>
                    <p><?php echo $email; ?></p>
                </td>
            </tr>
        </table>
        <input type="button" value="戻る" onClick="location.href = 'index.php'">
    </body>
</html>
