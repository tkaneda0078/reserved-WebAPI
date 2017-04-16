<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/api.php';

$api = new Api();

$reserve_code = $_SESSION['reserve_code'];

// 予約データを取得
$reserved_data = $api->fetchReservedData($reserve_code);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>予約WebAPI</title>
    </head>
    <body>
        <h1>予約データ</h1>
        <table>
            <tr>
                <th>名前：</th>
                <td>
                    <p><?php echo $reserved_data['name']; ?></p>
                </td>
            </tr>
            <tr>
                <th>メール：</th>
                <td>
                    <p><?php echo $reserved_data['email']; ?></p>
                </td>
            </tr>
        </table>
        <input type="button" value="top" onClick="location.href = '../index.php'">
    </body>
</html>
