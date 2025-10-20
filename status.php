<?php

$pageTitle = "迎新茶會報名";
include 'header.php';

// 如果尚未登入，導向 login.php 並記住原本頁面
if (!isset($_SESSION['name'])) {
  header("Location: login.php?redirect=status.php");
  exit;
}
?>

<div class="container py-5">
  <h2 class="mb-4 text-center">迎新茶會報名</h2>

  <form action="count.php" method="post" class="mx-auto" style="max-width: 500px;">
    <!-- 自動填入使用者姓名與身分 -->
    <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
   
    

    <div class="mb-3">
      <label class="form-label">是否需要用餐</label><br>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="meal" value="yes" required>
        <label class="form-check-label">需要晚餐</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="meal" value="no">
        <label class="form-check-label">不需要晚餐</label>
      </div>
    </div>

    <input type="hidden" name="event" value="tea">
    <button type="submit" class="btn btn-success w-100">送出報名</button>
  </form>
</div>

<?php include 'footer.php'; ?>

