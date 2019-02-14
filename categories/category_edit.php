<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>カテゴリー変更</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "GET") :
    include("../model/Category.php");
    $id = $_GET["id"];
    $category = Category::find($id);
    if (!ctype_digit($id)||empty($category)) {
      header("location:../error.php");
      exit();
    }

    ?>

    <form action="category_edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p>名前：<input type="text" name="name" value="<?php echo $category->name; ?>"></p></br>
      <p>説明：<textarea name="introduction">
    <?php echo $category->introduction; ?>
  </textarea></p>
    <input type="submit" value="提出">
    </form>
    </br><button><a href="../home.php">ホームページ</a></button>
    <?php
  else:
    include("../model/Category.php");

    $id = $_POST["id"];
    $name = $_POST["name"];
    $introduction = $_POST["introduction"];

    $category = Category::find($id);

    $category->name = $name;
    $category->introduction = $introduction;

    $result = $category->update();

    if($result > 0) {
      echo "<p class=\"change\">変更成功";
      echo "</br><button><a href=\"category_index.php\">back</a></button></p>";
    } else {
      echo "<p class=\"change\">変更失敗";
      echo "</br><button><a href=\"category_index.php\">back</a></button></p>";
    }
  endif;
  ?>

  </body>
</html>
