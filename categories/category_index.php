<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>カテゴリー一覧</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>

  <body>
    <h2>カテゴリー一覧</h2>
    <div class="index">
    <?php
    include("../model/Category.php");
    $result = Category::get();
    ?>
    <table id="table">
      <tr>
        <th>ID</th>
        <th>name</th>
        <th>introduction</th>
        <th>編集</th>
        <th>削除</th>
      </tr>

      <?php
      foreach($result as $category):
       ?>

       <tr>
         <td><a href="category_detail.php?id=<?php echo $category->id; ?>"><?php echo $category->id; ?></a></td>
         <td><?php echo $category->name; ?></td>
         <td><?php echo $category->introduction; ?></td>
         <td><button><a href="category_edit.php?id=<?php echo $category->id; ?>" class="delete">UPDATE</a></button></td>
         <td><button><a href="category_delete.php?id=<?php echo $category->id; ?>" class="delete">DELETE</a></button></td>
       </tr>

     <?php endforeach; ?>
    </table>
    </br><button><a href="../home.php">ホームページ</a></button>
     </div>
  </body>
</html>
