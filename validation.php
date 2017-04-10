<?php

class Validation {
    
    /*
     * Nullチェック
     * 
     * @param String 入力文字列
     * @return boolean ture：ok false：エラーメッセージ
     */
    public function isNull($val) {
	if ($val == null || strlen($val) == 0) {
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
    public function isLength($val) {
	if (strlen($val) < 5) {
	    return '入力文字数が５文字未満です。';
	} elseif (strlen($val) > 20) {
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
    public function isMailaddress($email) {
	if (preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $email)) {
	    return true;
	}
	
	return 'メールアドレスの形式が違います。';
    }
    
    
}
