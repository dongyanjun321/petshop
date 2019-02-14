<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

  </head>
  <body>
    <form action="order_index.php">
      <?php
    $id=$_GET['id'];

    include ("../model/Order.php");
    $order=Order::find($id);
    if (!ctype_digit($id)||empty($order)) {
      header("location:../error.php");
      exit();
    }
    $result=$order->delete();
    if ($result>0) {
      echo "削除成功";
    }else {
      echo "削除失敗";
    }
     ?>
   </br><input type="submit" name="submit" value="戻り">
    </form>
    </br><button><a href="../home.php">ホームページ</a></button>
  </body>
</html>
