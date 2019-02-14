<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>お客様追加</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>

    <?php  if($_SERVER['REQUEST_METHOD'] == "GET") :?>

    <h2>お客様追加</h2>
    <div class="form">
    <form action="customer_add.php" method="post">
      <div class="info-item">
        <table class="info">
          <tr>
            <th>お客様名前：</th>
            <th><input type="text" name="name"></th>
          </tr>
          <tr>
            <th>誕生日：</th>
            <th><input type="date" name="birthday"></th>
          </tr>
          <tr>
            <th>電話番号：</th>
            <th><input type="text" name="phone_number"></th>
          </tr>
          <tr>
            <th>メール：</th>
            <th><input type="email" name="mail"></th>
          </tr>
          <tr>
            <th>出身地：</th>
            <th>
              <select name="mtb_prefecture_id">
                <?php
                include("../model/Customer.php");
                $result = Customer::get_mtb_prefectures();
                  foreach($result as $prefectures):
                   ?>
                     <option value="<?php echo $prefectures->id?>"><?php echo $prefectures->value?></option>
                 <?php endforeach; ?>
              </select></th>
          </tr>
          <tr>
            <th><input type="submit" name="submit" value="送信"></th>
          </tr>
        </table>

    </div>
    </form>
    </div>

    <?php
  else:
    include("../model/Customer.php");

    $name = $_POST["name"];
    $birthday = $_POST["birthday"];
    $phone_number = $_POST["phone_number"];
    $mail = $_POST["mail"];
    $mtb_prefecture_id = $_POST["mtb_prefecture_id"];


    if(empty($name)||empty($birthday)||empty($phone_number)) {
      echo "<p>正しい情報が必要です。</p></br>";
      echo "<p><input type=\"submit\" name=\"submit\" value=\"戻り\"></p>";
      exit();
    }
    if (!is_numeric($phone_number)) {
      echo "<p>正しい電話番後が必要です。</p></br>";
      echo "<p><input type=\"submit\" name=\"submit\" value=\"戻り\"></p>";
      exit();
    }

    $customer=new Customer;
    $customer->name=$name;
    $customer->birthday=$birthday;
    $customer->phone_number=$phone_number;
    $customer->mail=$mail;
    $customer->mtb_prefecture_id=$mtb_prefecture_id;

    $result=$customer->insert();

    if ($result) {
      echo "<p>追加成功</p>";
    }else {
      echo "<p>追加失敗</p>";
    }
      endif;
    ?>

    </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
