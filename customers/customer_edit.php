<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>お客様情報変更</title>
  </head>
  <body>
    <?php
    include("../model/Appointment.php");
    include("../model/Customer.php");
    if($_SERVER['REQUEST_METHOD'] == "GET") :
    $id = $_GET["id"];

    $customer = Customer::find($id);

    ?>
    <h2>お客様情報変更</h2>
    <form action="customer_edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p>お客様名前：<input type="text" name="name" value="<?php echo $customer->name?>"></p>
      <p>生年月日:<input type="date" name="birthday" value="<?php echo $customer->birthday?>"></p>
      <p>電話番号：<input type="text" name="phone_number" value="<?php echo $customer->phone_number; ?>"></p>
      <p>メール：<input type="email" name="mail" value="<?php echo $customer->mail; ?>"></p>
      <p>出身地:
        <select name="mtb_prefecture_id">
          <?php
          $result = Customer::get_mtb_prefectures();
            foreach($result as $prefectures):
             ?>
               <option value="<?php echo $prefectures->id?>"><?php echo $prefectures->value?></option>
           <?php endforeach; ?>
        </select>
      </p>
      <input type="submit" value="提出">
    </form>

    <?php
      else:
      $id = $_POST["id"];
      $name=$_POST["name"];
      $birthday=$_POST["birthday"];
      $phone_number=$_POST["phone_number"];
      $mail=$_POST["mail"];
      $mtb_prefecture_id=$_POST["mtb_prefecture_id"];

      $customer = Customer::find($id);

      $customer->id=$id;
      $customer->name=$name;
      $customer->birthday=$birthday;
      $customer->phone_number=$phone_number;
      $customer->mail=$mail;
      $customer->mtb_prefecture_id=$mtb_prefecture_id;

      $result = $customer->update();

      if($result > 0) {
        echo "<p class=\"change\">変更成功";
        echo "</br><button><a href=\"customer_index.php\">back</a></button></p>";
      } else {
        echo "<p class=\"change\">変更失敗";
        echo "</br><button><a href=\"customer_index.php\">back</a></button></p>";
      }
    endif;
  ?>

  </body>
</html>
