<!DOCTYPE html>
<?php

$pageTitle = "活動報名首頁";
include 'header.php';
try {
  require_once 'db.php';
  $sql="select * from event";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  }
  catch(Exception $e) {
  echo "Message:".$e->getMessage();
  }
?>

<div class="container py-5 text-center">
  <h1>🎉 歡迎報名活動</h1>
  <p class="mb-4">請選擇下方活動進行報名</p>

  <!-- 活動快速報名按鈕 -->
  <a href="status.php" class="btn btn-primary m-2">迎新茶會</a>
  <a href="conference.php" class="btn btn-success m-2">資管一日營</a>

  <!-- 活動介紹卡片 -->
  <div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col">
          <div class="card">
            <h1><?= $row["name"] ?></h1>
            <p><?= $row["description"] ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>
</body>
</html>
