<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ペット情報</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
    <body>
      <h2>ペット情報</h2>
      <div class="info">
        <form action="pet_index.php" method="get">
          <?php
          include("../model/Pet.php");
          include("../model/Category.php");
          $id = $_GET["id"];
          $pet = Pet::find($id);
          if (!ctype_digit($id)||empty($pet)) {
            header("location:../error.php");
            exit();
          }

          ?>

          <?php if($pet): ?>
            <p>ID:<?php echo $pet->id ?></p>
            <p>ペットコード：<?php echo $pet->code?></p>
            <p>カテゴリー：<?php
                 $category_id=$pet->category_id;
                 $category=Category::find($category_id);
                 echo $category->name;
             ?></p>
            <p>生年月日：<?php echo $pet->birthday?></p>
            <p>性別：<?php if ($pet->gender_flg=="1") {
                  echo "MALE";
                }elseif ($pet->gender_flg=="2") {
                  echo "FEMALE";
                }else {
                  echo "UNKNOW";
                } ?></p>
            <p>ワクチン：<?php if ($pet->vaccination_flg=="1") {
                  echo "DONE";
                }else {
                  echo "UNDONE";
                }?></p>
            <p>価格：<?php echo $pet->price ?></p>

          <?php else: ?>
            <p>該当petがありません。</p>
          <?php endif; ?>
        </br><p><input type="submit" name="submit" value="back"></p>
        </form>
        </br><button><a href="../home.php">ホームページ</a></button>
      </div>
    </body>
</html>
