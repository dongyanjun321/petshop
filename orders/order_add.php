<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>購入追加</title>
  </head>
  <body>
    <?php  if($_SERVER['REQUEST_METHOD'] !== "POST") :?>
    <h2>購入追加</h2>
    <form action="order_add.php" method="post">
        <table class="info">
          <tr>
            <th>ペットコード：</th>
            <th>
              <select name="pet_id">
                <?php
                include("../model/Pet.php");
                $result = Pet::get_left_pet();
                  foreach($result as $pet):
                   ?>
                     <option value="<?php echo $pet->id?>"><?php echo $pet->code?></option>
                 <?php endforeach; ?>
              </select>
            </th>
          </tr>
          <tr>
            <th>お客様名前：</th>
            <th>
              <select name="customer_id">
                <?php
                include("../model/Customer.php");
                $result = Customer::get();
                  foreach($result as $customer):
                   ?>
                     <option value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
                 <?php endforeach; ?>

              </select></th>
          </tr>
          <tr>
            <th>購入状況：</th>
            <th><select name="mtb_order_statu_id">
              <option value ="1">注文済み</option>
              <option value="2">配達済み</option>
              <option value="3">キャンセル</option>
              <option value="4">返品済み</option>
            </select></th>
          </tr>
          <tr>
            <th>購入価格：</th>
            <th>￥<input type="text" name="order_price"></th>
          </tr>
          <tr>
            <th>購入時間：</th>
            <th><input type="datetime-local" name="order_time"></th>
          </tr>

          <tr>
            <th><input type="submit" name="submit" value="送信"></th>
          </tr>
        </table>
    </form>

    <?php
      else:
        include("../model/Order.php");
        include("../model/Pet.php");
        include("../model/Customer.php");

        $customer_id = $_POST["customer_id"];
        $pet_id = $_POST["pet_id"];
        $order_time = $_POST["order_time"];
        $order_price = $_POST["order_price"];
        $mtb_order_statu_id = $_POST["mtb_order_statu_id"];

        if(empty($order_time)||empty($customer_id)||empty($pet_id)||empty($order_price)||empty($mtb_order_statu_id)) {
          echo "<p>購入情報が必要です。</p></br>";
          echo "</br><button><a href=\"order_add.php\">back</a></button></p>";
          exit();
        }

        $order=new Order;
        $order->customer_id=$customer_id;
        $order->pet_id=$pet_id;
        $order->order_time=$order_time;
        $order->mtb_order_statu_id=$mtb_order_statu_id;
        $order->order_price=$order_price;
        $result=$order->insert();

        if ($result) {
          echo "<p>追加成功</p>";
          echo "</br><button><a href=\"order_add.php\">back</a></button></p>";
        }else {
          echo "<p>追加失敗</p>";
          echo "</br><button><a href=\"order_add.php\">back</a></button></p>";
        }
      endif;
        ?>
        </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
