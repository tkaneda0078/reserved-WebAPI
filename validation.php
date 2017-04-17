<?php

require $_SERVER['DOCUMENT_ROOT'] . '/api.php';

class Validation
{
    /*
     * Nullチェック
     * 
     * @param String 入力文字列
     * @return boolean ture：ok false：エラーメッセージ
     */

    public function isNull($val)
    {
        if ($val == null || strlen($val) == 0)
        {
            return '入力をしてください。';
        }

        return true;
    }
    
    /*
     * 文字数チェック
     * 
     * @param String 入力文字列
     * @return boolean true：ok false：エラーメッセージ
     */

    public function isLength($val)
    {
        if (strlen($val) < 2)
        {
            return '入力文字数が2文字未満です。';
        }
        elseif (strlen($val) > 20)
        {
            return '入力文字数が２０文字を超えています。';
        }

        return true;
    }
    
    /*
     * メールアドレス
     * 
     * @param 入力メールアドレス
     * @return boolean true：ok false：エラーメッセージ
     */

    public function isMailaddress($email)
    {
        $api = new Api();
        // メールアドレスを取得
        // 重複チェック
        $unique_mail_address = $api->fetchDuplicateMailAddress($email);

        if (isset($unique_mail_address))
        {
            return '入力したメールアドレスは既に登録されています。';
        }

        if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $email))
        {
            return 'メールアドレスの形式が違います。';
        }

        return true;
    }
    
}
