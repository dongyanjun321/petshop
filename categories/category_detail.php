<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>カテゴリー情報</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <h2>カテゴリー情報</h2>
    <div class="info">
      <form action="category_index.php" method="get">
        <?php
        include("../model/Category.php");
        $category_id = $_GET["id"];
        $category = Category::find($category_id);

         ?>
         <div class="info">
        <?php if($category): ?>
        <p>ID：<?php echo $category->id; ?></p>
        <p>カテゴリ名：<?php echo $category->name; ?></p>
        <p>カテゴリ説明：<?php echo $category->introduction; ?></p>

        <?php else: ?>
          <p>該当レコードがありません。</p>
        <?php endif; ?>
        </br><p><input type="submit" name="submit" value="戻り"></p>
      </form>
      </br><button><a href="../home.php">ホームページ</a></button>
    </div>
  </body>
</html>
