<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>予約状況一覧</title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">
  </head>
  <body>
    <h2>予約一覧</h2>
    <div class="index">
      <table id="table">
        <tr>
          <th>ID</th>
          <th>お客様ID</th>
          <th>ペットID</th>
          <th>予約時間</th>
          <th>予約状況</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>

      <?php
      include("../model/Appointment.php");
      $result = Appointment::get();
        foreach($result as $appointment):
         ?>
         <tr>
           <td><a href="appointment_detail.php?id=<?php echo $appointment->id;?>&mtb_appointment_statu_id=<?php echo $appointment->mtb_appointment_statu_id ?>"><?php echo $appointment->id; ?></a></td>
           <td><?php echo $appointment->customer_id?></td>
           <td><?php echo $appointment->pet_id?></td>
           <td><?php echo $appointment->appointment_time?></td>
           <td><?php if ($appointment->mtb_appointment_statu_id=="1") {
             echo "予約済み";
               }elseif ($appointment->mtb_appointment_statu_id=="2") {
                 echo "来店済み";
               }else {
                 echo "キャンセル";
               }

            ?></td>
           <td><button><a href="appointment_edit.php?id=<?php echo $appointment->id;?>" class="change">UPDATE</a></button></td>
           <td><button><a href="appointment_delete.php?id=<?php echo $appointment->id;?>" class="change">DELETE</a></button></td>
         </tr>
       <?php endforeach; ?>
      </table>
      </br><button><a href="../home.php">ホームページ</a></button>
    </div>
  </body>
</html>
