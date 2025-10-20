<?php
$pageTitle = "報名結果";
include 'header.php';
?>
<?php

// 從表單接收活動類型與選項
$event = $_POST['event'] ?? '';
$role = $_SESSION['role'] ?? '';
$name = $_SESSION['name'] ?? '';
$fee = 0; // 初始化費用為 0

// 根據身分與活動類型計算費用
if ($role === 'teacher') {
  $fee = 0; // 老師免費
} else {
  if ($event === 'tea') {
    // 茶會：radio 傳來 yes 或 no
    $meal = $_POST['meal'] ?? 'no';
    $fee = ($meal === 'yes') ? 60 : 0;
  } elseif ($event === 'camp') {
    // 一日營：學生參加場次與午餐加總
    $fee += isset($_POST['am']) ? 150 : 0;
    $fee += isset($_POST['pm']) ? 100 : 0;
    $fee += isset($_POST['lunch']) ? 50 : 0;
  }
 
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<div class="container py-5 text-center">
  <h2>報名成功！</h2>
  <p>姓名：<?= htmlspecialchars($name) ?></p>
  <p>活動：<?= $event === 'tea' ? '迎新茶會' : '資管一日營' ?></p>
  <p>應繳費用：<?= $fee ?> 元</p>
  <a href="index.php" class="btn btn-secondary mt-3">回首頁</a>
</div>
<?php include 'footer.php'; ?>
</body>
</html>

