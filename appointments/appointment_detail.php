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
        <form action="appointment_index.php" method="get">
          <?php
          include("../model/Appointment.php");
          $id = $_GET["id"];
          $statu_id=$_GET["mtb_appointment_statu_id"];
          $appointment = Appointment::find($id);
          $appointment_statu = Appointment::find_mtb_appointment_statu_id($statu_id);
          if (!ctype_digit($id)||!ctype_digit($statu_id)||empty($appointment)||empty($appointment_statu)) {
            header("location:../error.php");
            exit();
          }
          ?>

          <?php if($appointment): ?>
            <p>ID:<?php echo $appointment->id ?></p>
            <p>お客様ID ：<?php echo $appointment->customer_id?></p>
            <p>ペットID：<?php echo $appointment->pet_id?></p>
            <p>予約日：<?php echo $appointment->appointment_time?></p>
            <p>予約状況：<?php echo $appointment_statu->appointment_statu?></p>

          <?php else: ?>
            <p>該当予約がありません。</p>
          <?php endif; ?>
          </br><p><input type="submit" name="submit" value="戻り"></p>
        </form>
        </br><button><a href="../home.php">ホームページ</a></button>
      </div>
    </body>
</html>
