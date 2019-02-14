<?php
require_once("../model/Connect.php");
class Order extends Connect{

  public $id;
  public $pet_id;
  public $customer_id;
  public $mtb_order_statu_id;
  public $order_price;
  public $order_time;
  public $created_at;
  public $updated_at;
  public $deleted_at;


  public function insert()
  {
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    try {
      $stmt = $conn->prepare("INSERT INTO orders (pet_id,customer_id,mtb_order_statu_id,order_price,order_time, created_at, updated_at)
              VALUES (:pet_id,:customer_id,:mtb_order_statu_id,:order_price,:order_time,Now(), Now())");
              $stmt->bindparam(":pet_id", $this->pet_id);
              $stmt->bindparam(":customer_id", $this->customer_id);
              $stmt->bindparam(":mtb_order_statu_id", $this->mtb_order_statu_id);
              $stmt->bindparam(":order_price", $this->order_price);
              $stmt->bindparam(":order_time", $this->order_time);

              $stmt->execute();

              $result= $stmt->rowCount();
              return $result;
    } catch(PDOException $e) {
        $conn = null;
        return false;
    }
  }

  public function update()
  {

    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    try {
      $stmt = $conn->prepare("UPDATE orders SET
         pet_id= :pet_id, customer_id= :customer_id, mtb_order_statu_id= :mtb_order_statu_id,order_price= :order_price,
         order_time= :order_time, updated_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->bindparam(":pet_id", $this->pet_id);
      $stmt->bindparam(":customer_id", $this->customer_id);
      $stmt->bindparam(":mtb_order_statu_id", $this->mtb_order_statu_id);
      $stmt->bindparam(":order_price", $this->order_price);
      $stmt->bindparam(":order_time", $this->order_time);
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


  public static function get()
  {
    $result_arr = array();
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM orders WHERE deleted_at IS NULL");
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");

    while($row = $stmt->fetch()) {
      $result_arr[] = $row;
    }
    return $result_arr;
  }

  public static function find($id) {

    $order = null;

    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id=:id");
    $stmt->bindparam(":id", $id);
    $stmt->execute();
    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");
    while($row = $stmt->fetch()) {
      $order = $row;
      break;
    }
    return $order;
}

public static function find_by_pet_id($pet_id) {

  $order = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM orders WHERE pet_id = $pet_id");

  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");
  while($row = $stmt->fetch()) {
    $order = $row;
    break;
  }
  return $order;
}

public function delete(){
  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("UPDATE orders SET deleted_at = Now()  WHERE id=:id");
  $stmt->bindparam(":id", $this->id);
  $stmt->execute();

  $result= $stmt->rowCount();
  return $result;
}

public static function find_mtb_order_statu_id($id)
{
  $mtb_order_statu = null;

  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM mtb_order_status WHERE id=:id");
  $stmt->bindparam(":id", $id);
  $stmt->execute();
  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");
  while($row = $stmt->fetch()) {
    $mtb_order_statu = $row;
    break;
  }
  return $mtb_order_statu;
}

public static function get_mtb_order_status()
{
  $result_arr = array();
  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("SELECT * FROM mtb_order_status");
  $stmt->execute();

  // 设置结果集为关联数组
  $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");

  while($row = $stmt->fetch()) {
    $result_arr[] = $row;
  }
  return $result_arr;
}

}
