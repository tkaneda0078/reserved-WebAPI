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
            exit();
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
     * 予約データを取得
     * 
     * 予約コードをもとにDBから予約データを取得
     * 
     * @access public
     * $return array $reserve_code 予約データ
     */

    public function fetchReservedData($reserve_code)
    {
        try
        {
            $sql = "SELECT name, email FROM reserved WHERE reserve_code = :reserve_code";

            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(':reserve_code' => $reserve_code));
            $reserved_data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($reserved_data))
            {
                echo '取得できるデータはありません。';
                exit();
            }

            return $reserved_data;
        }
        catch (Exception $ex)
        {
            echo 'ERROR:' . $ex->getMessage();
            echo '予約データ取得失敗';
            exit();
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

    /*
     * 既に登録されているメールアドレスを取得
     * 
     * 重複チャック時に使用
     * 
     * @access public
     * $return boolean
     */

    public function fetchDuplicateMailAddress($email)
    {
        try
        {
            $sql = "SELECT email FROM reserved WHERE email = :email limit 1";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(array(':email' => $email));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data['email'];
        }
        catch (Exception $ex)
        {
            echo 'ERROR:' . $ex->getMessage();
            echo 'メールアドレス取得失敗。';
            exit();
        }
    }

}
