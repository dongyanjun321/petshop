<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>購入情報</title>
  </head>
    <body>
      <h2>購入情報</h2>
      <div class="info">
        <form action="order_index.php" method="get">
          <?php
          include("../model/Order.php");
          include("../model/Customer.php");
          include("../model/Pet.php");
          $id = $_GET["id"];
          $statu_id=$_GET["mtb_order_statu_id"];
          $order = Order::find($id);
          $order_statu = Order::find_mtb_order_statu_id($statu_id);
          if (!ctype_digit($id)||!ctype_digit($statu_id)||empty($order)||empty($order_statu)) {
            header("location:../error.php");
            echo "</br><button><a href=\"../home.php\">ホームページ</a></button></p>";
            exit();
          }
          ?>

          <?php if($order): ?>
            <p>購入ID:<?php echo $order->id ?></p>
            <p>ペットID：<?php echo $order->pet_id?></p>
            <p>ペットコード：<?php echo $order->pet_id?></p>
            <p>お客様ID ：<?php echo $order->customer_id?></p>
            <p>お客様名前 ：<?php $res = Customer::find($order->customer_id);
            echo $res->name?></p>
            <p>購入状況：<?php echo $order_statu->order_statu?></p>
            <p>購入金額：￥<?php echo $order->order_price?></p>
            <p>購入時間：<?php echo $order->order_time?></p>

          <?php else: ?>
            <p>該当購入がありません。</p>
          <?php endif; ?>
          </br><p><input type="submit" name="submit" value="戻り"></p>
        </form>
        </br><button><a href="../home.php">ホームページ</a></button>
      </div>
    </body>
</html>
