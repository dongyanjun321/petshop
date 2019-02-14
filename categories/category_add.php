<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>カテゴリー追加</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <?php  if($_SERVER['REQUEST_METHOD'] !== "POST") :?>
    <h2>カテゴリー追加</h2>
    <form action="category_add.php" method="post">
      <?php  include("../model/Category.php");  $result = Category::get();?>
      <table border="1">
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>introduction</th>
        </tr>
        <?php
        foreach($result as $category):
         ?>
         <tr>
           <td><a href="category_detail.php?id=<?php echo $category->id; ?>"><?php echo $category->id; ?></a></td>
           <td><?php echo $category->name; ?></td>
           <td><?php echo $category->introduction; ?></td>
         </tr>
       <?php endforeach; ?>
      </table>


      <p>追加カテゴリー名：<input type="text" name="name" value="" placeholder="カテゴリー名を入力してください。"></br>
      カテゴリー説明：<textarea name="introduction"></textarea></br></p>
      <input type="submit" name="submit" value="送信">
    </form>
    </br><button><a href="../home.php">ホームページ</a></button>
    <?php
  else:
    include("../model/Category.php");


    $name = $_POST["name"];
    $introduction = $_POST["introduction"];
    if(empty($name)) {
      echo "<p>カテゴリー名が必要です。</p></br>";
      echo "</br><button><a href=\"category_add.php\">back</a></button></p>";
      exit();
    }


    $category = new Category;
    $category->name=$name ;
    $category->introduction=$introduction;
    $result = $category->insert();

    if($result) {
      echo "<p>追加成功</p>";
      echo "</br><button><a href=\"category_add.php\">back</a></button></p>";
    } else {
      echo "<p>追加失敗</p>";
      echo "</br><button><a href=\"category_add.php\">back</a></button></p>";
    }
  endif;
      ?>
  </body>
</html>
