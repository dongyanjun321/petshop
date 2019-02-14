<?php
require_once("../model/Connect.php");
class Pet extends Connect{

  public $code;
  public $category_id;
  public $birthday;
  public $gender_flg;
  public $vaccination_flg;
  public $price;
  public $id;
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
      $stmt = $conn->prepare("INSERT INTO pets (code,category_id,birthday,gender_flg,vaccination_flg,price, created_at, updated_at)
              VALUES (:code,:category_id,:birthday,:gender_flg,:vaccination_flg,:price,Now(), Now())");
      $stmt->bindparam(":code", $this->code);
      $stmt->bindparam(":category_id", $this->category_id);
      $stmt->bindparam(":birthday", $this->birthday);
      $stmt->bindparam(":gender_flg", $this->gender_flg);
      $stmt->bindparam(":vaccination_flg", $this->vaccination_flg);
      $stmt->bindparam(":price", $this->price);

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
      $stmt = $conn->prepare("UPDATE pets SET
         code= :code, category_id= :category_id, birthday= :birthday,gender_flg= :gender_flg,
         vaccination_flg= :vaccination_flg, price= :price,updated_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->bindparam(":code", $this->code);
      $stmt->bindparam(":category_id", $this->category_id);
      $stmt->bindparam(":birthday", $this->birthday);
      $stmt->bindparam(":gender_flg", $this->gender_flg);
      $stmt->bindparam(":vaccination_flg", $this->vaccination_flg);
      $stmt->bindparam(":price", $this->price);
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
    $stmt = $conn->prepare("SELECT * FROM pets WHERE deleted_at IS NULL");
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Pet");

    while($row = $stmt->fetch()) {
      $result_arr[] = $row;
    }
    return $result_arr;
  }

  public static function find($id) {

    $pet = null;

    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id=:id");
    $stmt->bindparam(":id", $id);
    $stmt->execute();
    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Pet");
    while($row = $stmt->fetch()) {
      $pet = $row;
      break;
    }
    return $pet;
}
public function delete(){
  $conn = Connect::connect_db();
  if(!$conn) {
    return false;
  }
  $stmt = $conn->prepare("UPDATE pets SET deleted_at = Now()  WHERE id=:id");
  $stmt->bindparam(":id", $this->id);
  $stmt->execute();

  $result= $stmt->rowCount();
  return $result;
}


  public static function get_left_pet(){
    $result = array();
    $pets = self::get();
    require_once("Order.php");
    foreach($pets as $pet) {
      $order = Order::find_by_pet_id($pet->id);
      if($order && ($order->mtb_order_statu_id == "1" || $order->mtb_order_statu_id == "2")){
        continue;
      }else {
        $result[] = $pet ;
      }
    }
    return $result;
  }
}
