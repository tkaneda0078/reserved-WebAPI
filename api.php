<?php

/*
 * APIクラス
 * 
 * @access public
 * @package Controller
 */

class Api
{

    private $dbh;

    const DSN = 'mysql:host=localhost;dbname=webapi';
    const USER = 'root';
    const PASS = '';

    /*
     * DB接続
     * 
     * @access public
     */

    public function __construct()
    {
        try
        {
            $this->dbh = new PDO(
                self::DSN, self::USER, self::PASS, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                )
            );
        }
        catch (PDOException $e)
        {
            echo 'Connection failed: ' . $e->getMessage();
            echo 'DB接続失敗';
            exit;
        }
    }

    /*
     * データ登録用の関数
     * 
     * 入力値を登録と同時に予約コードを発行して、
     * 登録者に予約コードを返す
     * 
     * @access public
     * @return integer $reserve_code 予約コード
     */

    public function insert($name, $email)
    {
        try
        {
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //トランザクション開始
            $this->dbh->beginTransaction();

            // 予約コード発行
            $reserve_code = $this->getReservedCode();

            $sql = 'INSERT INTO reserved (reserve_code, name, email) VALUES (:reserve_code, :name, :email)';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':reserve_code', $reserve_code, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            $stmt->execute();

            // コミット
            $this->dbh->commit();

            return $reserve_code;
        }
        catch (PDOException $e)
        {
            // ロールバック
            $pdo->rollBack();
            echo 'ERROR:' . $e->getMessage();
            echo '登録失敗';
            exit;
        }
    }

    /*
     * 一意の予約コードを発行用の関数
     * 
     * @access privete
     * @return integer $unique_code 予約コード
     */

    private function getReservedCode()
    {
        // 一意のコードを発行
        $unique_code = uniqid(mt_rand());

        return $unique_code;
    }

}
