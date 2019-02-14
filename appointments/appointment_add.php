<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>予約追加</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <?php  if($_SERVER['REQUEST_METHOD'] !== "POST") :?>
    <h2>予約追加</h2>
    <form action="appointment_add.php" method="post">
        <table class="info">
          <tr>
            <th>お客様名前：</th>
            <th>
              <select name="customerid">
                <?php
                include("../model/Customer.php");
                $result = Customer::get();
                  foreach($result as $customer):
                   ?>
                     <option value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
                 <?php endforeach; ?>
              </select>
            </th>
          </tr>
          <tr>
            <th>ペットコード：</th>
            <th>
              <select name="petid">
                <?php
                include("../model/Pet.php");
                $result = Pet::get();
                  foreach($result as $pet):
                   ?>
                     <option value="<?php echo $pet->id?>"><?php echo $pet->code?></option>
                 <?php endforeach; ?>

              </select></th>
          </tr>
          <tr>
            <th>予約時間：</th>
            <th><input type="datetime-local" name="appointment_time"></th>
          </tr>
          <tr>
            <th>予約状況：</th>
            <th><select name="mtb_appointment_statu_id">
              <option value ="1">予約済み</option>
              <option value="2">来店済み</option>
              <option value="3">キャンセル</option>
            </select></th>
          </tr>
          <tr>
          <tr>
            <th><input type="submit" name="submit" value="送信"></th>
          </tr>
        </table>
    </form>
    </br><button><a href="../home.php">ホームページ</a></button>
    <?php
      else:
        include("../model/Appointment.php");
        include("../model/Pet.php");
        include("../model/Customer.php");

        $customer_id = $_POST["customerid"];
        $pet_id = $_POST["petid"];
        $appointment_time = $_POST["appointment_time"];
        $mtb_appointment_statu_id = $_POST["mtb_appointment_statu_id"];

        if(empty($appointment_time)) {
          echo "<p>予約時間が必要です。</p></br>";
          echo "</br><button><a href=\"appointment_add.php\">back</a></button></p>";
          exit();
        }

        $appointment=new Appointment;
        $appointment->customer_id=$customer_id;
        $appointment->pet_id=$pet_id;
        $appointment->appointment_time=$appointment_time;
        $appointment->mtb_appointment_statu_id=$mtb_appointment_statu_id;
        $result=$appointment->insert();

        if ($result) {
          echo "<p>追加成功</p>";
          echo "</br><button><a href=\"appointment_add.php\">back</a></button></p>";
        }else {
          echo "<p>追加失敗</p>";
          echo "</br><button><a href=\"appointment_add.php\">back</a></button></p>";
        }
      endif;
        ?>
  </body>
</html>
