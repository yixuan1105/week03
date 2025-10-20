<?php
require_once "header.php";
try {
  require_once 'db.php';
  $sql="select * from job";
  $result = mysqli_query($conn, $sql);
?>
<div class="container">
<table class="table table-bordered table-striped">
 <tr>
  <td>求才廠商</td>
  <td>求才內容</td>
  <td>日期</td>
 </tr>
 <?php
 while($row = mysqli_fetch_assoc($result)) {?>
 <tr>
  <td><?=$row["company"]?></td>
  <td><?=$row["content"]?></td>
  <td><?=$row["pdate"]?></td>
 </tr>
 <?php
  }
 ?>
</table>
</div>
<?php
  mysqli_close($conn);
}
//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
require_once "footer.php";
?>