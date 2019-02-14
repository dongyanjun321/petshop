<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ペット情報一覧</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <h2>ペット情報一覧</h2>
    <div class="index">
      <?php
      include("../model/Pet.php");
      include("../model/Category.php");
      include("../model/Order.php");
      $result = Pet::get();
      ?>
      <table id="table">
        <tr>
          <th>ID</th>
          <th>code</th>
          <th>品種</th>
          <th>　生年月日　</th>
          <th>性別</th>
          <th> ワクチン </th>
          <th>価格</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>
        <?php

        foreach($result as $pet):

         ?>
         <tr>
           <td><a href="pet_detail.php?id=<?php echo $pet->id;?>"><?php echo $pet->id; ?></a></td>
           <td><?php echo $pet->code?></td>
           <td><?php
                $category_id=$pet->category_id;
                $category=Category::find($category_id);
                echo $category->name;
            ?></td>
           <td><?php echo $pet->birthday?></td>
           <td><?php if ($pet->gender_flg=="1") {
               echo "MALE";
             }elseif ($pet->gender_flg=="2") {
               echo "FEMALE";
             }else {
               echo "UNKNOW";
             } ?></td>
           <td><?php if ($pet->vaccination_flg=="1") {
               echo "DONE";
             }else {
               echo "UNDONE";
             }?></td>
           <td>￥<?php echo $pet->price?></td>
           <td><button><a href="pet_edit.php?id=<?php echo $pet->id;?>" class="delete">UPDATE</a></button></td>
           <td><button><a href="pet_delete.php?id=<?php echo $pet->id;?>" class="delete">DELETE</a></button></td>
         </tr>
       <?php
     endforeach; ?>
      </table></br>
    <div class="home_button">
      <a href="../home.php"><button>ホームページ</button></a>
    </div>
  </body>
</html>
