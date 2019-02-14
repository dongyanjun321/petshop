<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>購入情報変更</title>
  </head>
  <body>
    <h1>購入情報変更</h1>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "GET") :
    include("../model/Order.php");
    include("../model/Pet.php");
    include("../model/Customer.php");
    $id = $_GET["id"];

    $order = Order::find($id);

    if (!ctype_digit($id)||empty($order)) {
      header("location:../error.php");
      exit();
    }
    ?>
    <h2>予約情報変更</h2>
    <form action="order_edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p>ペットコード：
        <select name="pet_id">
          <?php
          $result = Pet::get();
            foreach($result as $pet):
             ?>
               <option value="<?php echo $pet->id?>"><?php echo $pet->code?></option>
           <?php endforeach; ?>
         </select></p>
      <p>お客様名前：
        <select name="customer_id">
          <?php
            $result = Customer::get();
            foreach($result as $customer):
          ?>
          <option value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
          <?php endforeach; ?>
        </select></p>
      <p>購入状況：
        <select name="mtb_order_statu_id">
          <?php
          $result = Order::get_mtb_order_status();
            foreach($result as $order_statu):
             ?>
               <option value="<?php echo $order_statu->id?>"><?php echo $order_statu->order_statu?></option>
           <?php endforeach; ?>
         </select></p>
      <p>購入金額：<input type="text" name="order_price" value="<?php echo $order->order_price ?>"></p>
      <p>購入時間：<input type="datetime-local" name="order_time" value="<?php echo str_replace(" ", "T", $order->order_time); ?>"></p>

      <input type="submit" value="提出">
    </form>

    <?php
      else:
        include("../model/Order.php");

        $id = $_POST["id"];
        $customer_id=$_POST["customer_id"];
        $pet_id=$_POST["pet_id"];
        $order_time=$_POST["order_time"];
        $mtb_order_statu_id=$_POST["mtb_order_statu_id"];
        $order_price=$_POST["order_price"];


        $order = Order::find($id);

        $order->customer_id=$customer_id;
        $order->pet_id=$pet_id;
        $order->order_time=$order_time;
        $order->mtb_order_statu_id=$mtb_order_statu_id;
        $order->order_price=$order_price;

        $result = $order->update();

        if($result > 0) {
          echo "<p class=\"change\">変更成功";
          echo "</br><button><a href=\"order_index.php\">back</a></button></p>";
        } else {
          echo "<p class=\"change\">変更失敗";
          echo "</br><button><a href=\"order_index.php\">back</a></button></p>";
        }
      endif;
    ?>
    </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
