<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>予約情報変更</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "GET") :
    include("../model/Appointment.php");
    include("../model/Pet.php");
    include("../model/Customer.php");
    $id = $_GET["id"];

    $appointment = Appointment::find($id);

    $result = Customer::get();
    if (!ctype_digit($id)||empty($appointment)) {
      header("location:../error.php");
      exit();
    }
    ?>
    <h2>予約情報変更</h2>
    <form action="appointment_edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <p>お客様名前：
        <select name="customer_id">
          <?php

            foreach($result as $customer):
          ?>
          <option value="<?php echo $customer->id?>"><?php echo $customer->name?></option>
          <?php endforeach; ?>
        </select></p>
      <p>ペットコード：
        <select name="pet_id">
          <?php
          $result = Pet::get();
            foreach($result as $pet):
             ?>
               <option value="<?php echo $pet->id?>"><?php echo $pet->code?></option>
           <?php endforeach; ?>
         </select></p>
      <p>予約日：<input type="datetime-local" name="appointment_time" value="<?php echo str_replace(" ", "T", $appointment->appointment_time); ?>"></p>
      <p>予約状況：
        <select name="mtb_appointment_statu_id">
          <option value="1">予約済み</option>
          <option value="2">来店済み</option>
          <option value="3">キャンセル</option>
        </select></p>
      <input type="submit" value="提出">
    </form>
    </br><button><a href="../home.php">ホームページ</a></button>

    <?php
  else:
    include("../model/Appointment.php");

    $id = $_POST["id"];
    $customer_id=$_POST["customer_id"];
    $pet_id=$_POST["pet_id"];
    $appointment_time=$_POST["appointment_time"];
    $mtb_appointment_statu_id=$_POST["mtb_appointment_statu_id"];

    $appointment = Appointment::find($id);

    $appointment->customer_id=$customer_id;
    $appointment->pet_id=$pet_id;
    $appointment->appointment_time=$appointment_time;
    $appointment->mtb_appointment_statu_id=$mtb_appointment_statu_id;

    $result = $appointment->update();

    if($result > 0) {
      echo "<p class=\"change\">変更成功";
      echo "</br><button><a href=\"appointment_index.php\">back</a></button></p>";
    } else {
      echo "<p class=\"change\">変更失敗";
      echo "</br><button><a href=\"appointment_index.php\">back</a></button></p>";
    }
  endif;
?>

  </body>
</html>
