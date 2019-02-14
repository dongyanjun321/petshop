<?php
require_once("../model/Connect.php");
class Category extends Connect{

  public $name;
  public $introduction;
  public $column;
  public $after;
  public $value;
  public $created_at;
  public $updated_at;
  public $deleted_at;
  public $id;



  public function insert()
  {
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    try {
      $stmt = $conn->prepare("INSERT INTO categories (name, introduction, created_at, updated_at)
      VALUES (:name,:introduction, Now(), Now())");
      $stmt->bindparam(":name", $this->name);
      $stmt->bindparam(":introduction", $this->introduction);

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


    $stmt = $conn->prepare("UPDATE categories SET name = :name, introduction = :introduction, updated_at = NOW() WHERE id=:id");
    $stmt->bindparam(":name", $this->name);
    $stmt->bindparam(":introduction", $this->introduction);
    $stmt->bindparam(":id", $this->id);
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->rowCount();

    return $result;
  }



    public function delete(){
      $conn = Connect::connect_db();
      if(!$conn) {
        return false;
      }
      $stmt = $conn->prepare("UPDATE categories SET deleted_at = Now()  WHERE id=:id");
      $stmt->bindparam(":id", $this->id);
      $stmt->execute();

      $result= $stmt->rowCount();
      return $result;
    }



  public static function get()
  {
    $result_arr = array();
    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM categories WHERE deleted_at IS NULL");
    $stmt->execute();

    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");

    while($row = $stmt->fetch()) {
      $result_arr[] = $row;
    }
    return $result_arr;
  }



  public static function find($id) {

    $category = null;

    $conn = Connect::connect_db();
    if(!$conn) {
      return false;
    }
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id=:id");
    $stmt->bindparam(":id", $id);
    $stmt->execute();
    // 设置结果集为关联数组
    $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");
    while($row = $stmt->fetch()) {
      $category = $row;
      break;
    }
    return $category;
}
}
