<?php
require_once("../model/Connect.php");
class Customer extends Connect{

  public $id;
  public $name;
  public $birthday;
  public $phone_number;
  public $mail;
  public $mtb_prefecture_id ;
  public $purchase_history;
  public $reservation_status;
  public $created_at;
  public $updated_at;
  public $deleted_at;


//增
  public function insert()
  {
  $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }

    try {
      $stmt = $conn->prepare("INSERT INTO customers (name, birthday, phone_number, mail ,mtb_prefecture_id, created_at, updated_at)
      VALUES (:name, :birthday, :phone_number,:mail , :mtb_prefecture_id,Now(), Now())");
      $stmt->bindparam(":name", $this->name);
      $stmt->bindparam(":birthday", $this->birthday);
      $stmt->bindparam(":phone_number",  $this->phone_number);
      $stmt->bindparam(":mail",  $this->mail);
      $stmt->bindparam(":mtb_prefecture_id",  $this->mtb_prefecture_id);

      $stmt->execute();
      $result= $stmt->rowCount();
      return $result;

    } catch(PDOException $e) {
        $conn = null;
        return false;
    }
  }



  public function delete(){//删
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    try {
      $stmt = $conn->prepare("UPDATE customers SET deleted_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->execute();
      $result= $stmt->rowCount();
      return $result;
    } catch (PDOException $e) {
        $conn = null;
        return false;
    }
  }



  public function update()//改
  {
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    try {
      $stmt = $conn->prepare("UPDATE customers SET
         name = :name,birthday = :birthday,phone_number = :phone_number ,mail = :mail,
         mtb_prefecture_id = :mtb_prefecture_id,updated_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->bindparam(":name", $this->name);
      $stmt->bindparam(":birthday", $this->birthday);
      $stmt->bindparam(":phone_number", $this->phone_number);
      $stmt->bindparam(":mail", $this->mail);
      $stmt->bindparam(":mtb_prefecture_id", $this->mtb_prefecture_id);

      $stmt->execute();

      $result= $stmt->rowCount();
      return $result;
    }
    catch(PDOException $e)
    {
      $conn = null;
      return false;
    }
    }


    public static function get()//查找customer表
    {
      $result_arr = array();
      $conn = Connect::connect_db();
      if(!$conn) {
        return false;
      }
      $stmt = $conn->prepare("SELECT * FROM customers WHERE deleted_at IS NULL");
      $stmt->execute();

      // 设置结果集为关联数组
      $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");

      while($row = $stmt->fetch()) {
        $result_arr[] = $row;
      }
      return $result_arr;
    }



public static function find($id)//查找整张表
{
  $customer = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM customers WHERE id=:id");
  $stmt->bindparam(":id", $id);
  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
  while($row = $stmt->fetch()) {
    $customer = $row;
    break;
  }
  return $customer;
}

public static function find_by_mail($mail)//查找整张表
{
  $customer = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM customers WHERE mail = :mail");
  $stmt->bindparam(":mail", $mail);
  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
  while($row = $stmt->fetch()) {
    $customer = $row;
    break;
  }
  return $customer;
}
public static function find_by_phone($phone_number)//查找整张表
{
  $customer = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM customers WHERE phone_number = :phone_number");
  $stmt->bindparam(":phone_number", $phone_number);
  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
  while($row = $stmt->fetch()) {
    $customer = $row;
    break;
  }
  return $customer;
}

//mtb_appointment_statu_id check
public static function find_mtb_prefecture_id($id)
{
  $mtb_prefectures = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM mtb_prefectures WHERE id=:id");
  $stmt->bindparam(":id", $id);
  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");
  while($row = $stmt->fetch()) {
    $mtb_prefectures = $row;
    break;
  }
  return $mtb_prefectures;
}
public static function get_mtb_prefectures()
{
  $result_arr = array();
  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM mtb_prefectures");
  $stmt->execute();

  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Customer");

  while($row = $stmt->fetch()) {
    $result_arr[] = $row;
  }
  return $result_arr;
}
}
