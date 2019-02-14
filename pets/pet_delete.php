<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../css/css.css">

  </head>
  <body>
    <form action="pet_index.php">
      <?php
    $id=$_GET['id'];

    include ("../model/Pet.php");
    $pet=Pet::find($id);
    if (!ctype_digit($id)||empty($pet)) {
      header("location:../error.php");
      exit();
    }

    $result=$pet->delete();
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
