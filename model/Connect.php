<?php
class Connect{

  public static function connect_db()
  {
    // DBに接続する。
    $servername = "localhost";
    $username = "dong";
    $password = "000000";
    $dbname = "pet_shop";

    $conn = null;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // 设置 PDO 错误模式，用于抛出异常
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        $conn = null;
        return false;
    }
  }

}
