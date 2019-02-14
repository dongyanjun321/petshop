<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>お客様一覧</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <h2>お客様一覧</h2>
    <div class="form">
      <table  id="table">
        <tr>
          <th>ID</th>
          <th>お客様名前</th>
          <th>生年月日</th>
          <th>電話番号</th>
          <th>メール</th>
          <th>出身地</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>

      <?php
      include("../model/Customer.php");
      $result = Customer::get();
        foreach($result as $customer):
         ?>
         <tr>
           <td><a href="customer_detail.php?id=<?php echo $customer->id;?>&mtb_prefecture_id=<?php echo $customer->mtb_prefecture_id?>"><?php echo $customer->id; ?></a></td>
           <td><?php echo $customer->name?></td>
           <td><?php echo $customer->birthday?></td>
           <td><?php echo $customer->phone_number?></td>
           <td><?php echo $customer->mail?></td>
           <td><?php if (isset($customer->mtb_prefecture_id)){
             $mtb_prefecture_id=$customer->mtb_prefecture_id;
             $prefectures=Customer::find_mtb_prefecture_id($mtb_prefecture_id);
             echo $prefectures->value;
           }?></td>
           <td><button><a href="customer_edit.php?id=<?php echo $customer->id;?>" class="change">UPDATE</a></button></td>
           <td><button><a href="customer_delete.php?id=<?php echo $customer->id;?>" class="change">DELETE</a></button></td>
         </tr>
       <?php endforeach; ?>
      </table>
      </br><button><a href="../home.php">ホームページ</a></button>
    </div>
  </body>
</html>
