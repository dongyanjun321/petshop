<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ペット追加</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
      <?php  if($_SERVER['REQUEST_METHOD'] !== "POST") :?>
    <h2>ペット追加</h2>
    <form action="pet_add.php" method="post">
        <table class="info">
          <tr>
            <th>ペットコード：</th>
            <th><input type="text" name="code" value="<?php $petcode=mt_rand(100000,999999); echo $petcode?>"></th>
          </tr>
          <tr>
            <th>品種：</th>
            <th>
              <select name="category_id">
                <?php
                include("../model/Category.php");
                $result = Category::get();
                  foreach($result as $category):
                   ?>
                     <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                 <?php endforeach; ?>
              </select>
            </th>
          </tr>
          <tr>
            <th>生年月日：</th>
            <th><input type="date" name="birthday"></th>
          </tr>
          <tr>
            <th>性別：</th>
            <th><select name="gender_flg">
              <option value ="1">MALE</option>
              <option value="2">FEMALE</option>
              <option value="3">UNKNOW</option>
            </select></th>
          </tr>
          <tr>
            <th>ワクチン接種：</th>
            <th><select name="vaccination_flg">
              <option value ="1">DONE</option>
              <option value="2">UNDONE</option>
            </select></th>
          </tr>
          <tr>
            <th>価格：</th>
            <th><input type="text" name="price" value="">円</th>
          </tr>
          <tr>
            <th><input type="submit" name="submit" value="送信"></th>
          </tr>
        </table>
    </form>

    <?php
  else:
    include("../model/Pet.php");

    $code = $_POST["code"];
    $category_id = $_POST["category_id"];
    $birthday = $_POST["birthday"];
    $gender_flg = $_POST["gender_flg"];
    $vaccination_flg = $_POST["vaccination_flg"];
    $price = $_POST["price"];

    if(empty($category_id)||empty($code)||empty($gender_flg)||empty($vaccination_flg)||empty($price)) {
      echo "<p>ペット情報が必要です。</p></br>";
      echo "</br><button><a href=\"pet_add.php\">back</a></button></p>";
      exit();
    }

    $pet=new Pet;
    $pet->code=$code;
    $pet->category_id=$category_id;
    $pet->birthday=$birthday;
    $pet->gender_flg=$gender_flg;
    $pet->vaccination_flg=$vaccination_flg;
    $pet->price=$price;
    $result=$pet->insert();
    if ($result) {
      echo "<p>追加成功</p>";
      echo "</br><button><a href=\"pet_add.php\">back</a></button></p>";
    }else {
      echo "<p>追加失敗</p>";
      echo "</br><button><a href=\"pet_add.php\">back</a></button></p>";
    }

  endif;
     ?>
     </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
