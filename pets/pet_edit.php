<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ペット変更</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <?php
    include("../model/Pet.php");
    include("../model/Category.php");
    if($_SERVER['REQUEST_METHOD'] == "GET") :

    $id = $_GET["id"];
    $pet = Pet::find($id);

    if (!ctype_digit($id)||empty($pet)) {
      header("location:../error.php");
      exit();
    }


    ?>
    <h2>ペット情報変更</h2>
    <form action="pet_edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p>ペットコード：<input type="text" name="code" value="<?php echo $pet->code; ?>"></p>
      <p>カテゴリー：
        <select name="category_id">
        <?php
          $result = Category::get();
          foreach($result as $category):
        ?>
        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
        <?php endforeach; ?>
        </select></p>
      <p>生年月日：<input type="date" name="birthday" value="<?php echo $pet->birthday; ?>"></p>
      <p>性別：
        <select name="gender_flg">
          <option value="1">MALE</option>
          <option value="2">FEMALE</option>
          <option value="3">UNKNOW</option>
        </select></p>
      <p>ワクチン：
        <select name="vaccination_flg">
          <option value="1">DONE</option>
          <option value="2">UNDONE</option>
        </select></p>
      <p>価格：<input type="text" name="price" value="<?php echo $pet->price; ?>"></p>
      <input type="submit" value="提出">
    </form>
  </br><button><a href="../home.php">ホームページ</a></button>


    <?php
    else:
    $id = $_POST["id"];
    $code=$_POST["code"];
    $category_id=$_POST["category_id"];
    $birthday=$_POST["birthday"];
    $gender_flg=$_POST["gender_flg"];
    $vaccination_flg=$_POST["vaccination_flg"];
    $price=$_POST["price"];

    $pet = Pet::find($id);

    $pet->code=$code;
    $pet->category_id=$category_id;
    $pet->birthday=$birthday;
    $pet->gender_flg=$gender_flg;
    $pet->vaccination_flg=$vaccination_flg;
    $pet->price=$price;

    $result = $pet->update();

    if($result > 0) {
      echo "<p class=\"change\">変更成功";
      echo "</br><button><a href=\"pet_index.php\">back</a></button></p>";
    } else {
      echo "<p class=\"change\">変更失敗";
      echo "</br><button><a href=\"pet_index.php\">back</a></button></p>";
    }
  endif;
  ?>
  </body>
</html>
