<?php
require_once("../model/Connect.php");

class Appointment extends Connect{

  public $id;
  public $customer_id;
  public $pet_id;
  public $appointment_time;
  public $mtb_appointment_statu_id;
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
      $stmt = $conn->prepare("INSERT INTO appointments (customer_id,pet_id,appointment_time,mtb_appointment_statu_id, created_at, updated_at)
              VALUES (:customer_id,:pet_id,:appointment_time,:mtb_appointment_statu_id,Now(), Now())");
              $stmt->bindparam(":customer_id", $this->customer_id);
              $stmt->bindparam(":pet_id", $this->pet_id);
              $stmt->bindparam(":appointment_time", $this->appointment_time);
              $stmt->bindparam(":mtb_appointment_statu_id", $this->mtb_appointment_statu_id);

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
      $stmt = $conn->prepare("UPDATE appointments SET deleted_at = Now()  WHERE id=:id");
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
      $stmt = $conn->prepare("UPDATE appointments SET
         customer_id = :customer_id,pet_id = :pet_id,appointment_time = :appointment_time ,mtb_appointment_statu_id = :mtb_appointment_statu_id,updated_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->bindparam(":customer_id", $this->customer_id);
      $stmt->bindparam(":pet_id", $this->pet_id);
      $stmt->bindparam(":appointment_time", $this->appointment_time);
      $stmt->bindparam(":mtb_appointment_statu_id", $this->mtb_appointment_statu_id);
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


  public static function get()//查找整张表
  {
    $result_arr = array();
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE deleted_at IS NULL");
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Appointment");

    while($row = $stmt->fetch()) {
      $result_arr[] = $row;
    }
    return $result_arr;
  }




  public static function find($id) {//按id查找

    $appointment = null;
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM appointments WHERE id=:id");
    $stmt->bindparam(":id", $id);
    $stmt->execute();
    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Appointment");
    while($row = $stmt->fetch()) {
      $appointment = $row;
      break;
    }
    return $appointment;
}
}
