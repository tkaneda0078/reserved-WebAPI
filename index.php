<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (isset($_POST['reserve_code']))
    {
        $_SESSION['reserve_code'] = $_POST['reserve_code'];
        header('location:data/display.php');
        exit();
    }

    $error_msg = array();

    $name = $_POST['name'];
    $email = $_POST['email'];

    $val = new Validation();
    foreach ($_POST as $key => $value)
    {
        $error_msg[$key] = $val->isNull($value);
    }
    $error_msg[] = $val->isLength($name);
    $error_msg[] = $val->isMailaddress($email);

    if ($error_msg == true)
    {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header('location:issue.php');
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
                    <th>予約コード：</th>
                    <td>
                        <input type="text" name="reserve_code" id="reserve_code">
                    </td>
                </tr>
                <tr>
                    <th><span>※</span>名前：</th>
                    <td>
                        <input type="text" name="name" id="name" autofocus>
                    </td>
                </tr>
                <tr>
                    <th><span>※</span>メール：</th>
                    <td>
                        <input type="email" name="email" id="email">
                    </td>
                </tr>
            </table>
            <input type="submit" value="送信">
        </form>
    </body>
</html>
