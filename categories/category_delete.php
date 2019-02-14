<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
      <?php

    include("../model/Category.php");


    $id = $_GET["id"];

    $category = Category::find($id);
    $result = $category->delete();
    if (!ctype_digit($id)||empty($category)) {
      header("location:../error.php");
      exit();
    }

    if($result > 0) {
      echo "削除成功";
    } else {
      echo "削除失敗";
    }
     ?>
   </br><button><a href="category_index.php">戻り</a></button>
   </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
