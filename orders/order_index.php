<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>購入一覧</title>
  </head>
  <body>
    <h2>購入一覧</h2>
    <div class="form">
      <table border="1">
        <tr>
          <th>ID</th>
          <th>ペットコード</th>
          <th>お客様名前</th>
          <th>購入状況</th>
          <th>購入金額</th>
          <th>購入時間</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>

      <?php
      include("../model/Order.php");
      include("../model/Customer.php");
      include("../model/Pet.php");
      $result = Order::get();
        foreach($result as $order):
         ?>
         <tr>
           <td><a href="order_detail.php?id=<?php echo $order->id;?>&mtb_order_statu_id=<?php echo $order->mtb_order_statu_id ?>"><?php echo $order->id; ?></a></td>
           <td><?php $res = Pet::find($order->pet_id);
           echo $res->code?></td>
           <td><?php
             $res = Customer::find($order->customer_id);
             echo $res->name?></td>
           <td><?php $statu_id=$order->mtb_order_statu_id;
            $res= Order::find_mtb_order_statu_id($statu_id);
            echo $res->order_statu;
               ?></td>
           <td>￥<?php echo $order->order_price?></td>
           <td><?php echo $order->order_time?></td>


           <td><button><a href="order_edit.php?id=<?php echo $order->id;?>" class="change">UPDATE</a></button></td>
           <td><button><a href="order_delete.php?id=<?php echo $order->id;?>" class="change">DELETE</a></button></td>
         </tr>
       <?php endforeach; ?>
      </table>
      </br><button><a href="../home.php">ホームページ</a></button>
    </div>
  </body>
</html>
