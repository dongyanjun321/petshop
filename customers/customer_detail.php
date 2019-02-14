<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>予約情報</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
    <body>
      <h2>予約情報</h2>
      <div class="info">
        <form action="customer_index.php" method="get">
          <?php
          include("../model/Customer.php");
          $id = $_GET["id"];
          $prefecture_id=$_GET["mtb_prefecture_id"];
          $customer = Customer::find($id);
          $customer_prefecture = Customer::find_mtb_prefecture_id($prefecture_id);
          ?>

          <?php if($customer): ?>
            <p>ID:<?php echo $customer->id ?></p>
            <p>お客様名前 ：<?php echo $customer->name?></p>
            <p>生年月日:<?php echo $customer->birthday?></p>
            <p>電話番号：<?php echo $customer->phone_number?></p>
            <p>メール：<?php echo $customer->mail?></p>
            <p>出身地:<?php if (empty($prefecture_id)) {
              echo " ";
            }else {
              echo $customer_prefecture->value;
            }?></p>

          <?php else: ?>
            <p>該当予約がありません。</p>
          <?php endif; ?>
          </br><p><input type="submit" name="submit" value="戻り"></p>
        </form>
        </br><button><a href="../home.php">ホームページ</a></button>
      </div>
    </body>
</html>
