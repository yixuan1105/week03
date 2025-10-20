<?php
$pageTitle = "資管一日營報名";
include 'header.php';

// 如果尚未登入，導向登入頁並記住原本頁面
if (!isset($_SESSION['name'])) {
  header("Location: login.php?redirect=conference.php");
  exit;
}
?>

<div class="container py-5">
  <h2 class="mb-4 text-center">資管一日營報名</h2>

  <form action="count.php" method="post" class="mx-auto" style="max-width: 500px;">
    <!-- 自動填入使用者姓名與身分 -->
    <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
   

    <div class="mb-3">
      <label class="form-label">參加場次</label><br>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="am" value="yes" id="am">
        <label class="form-check-label" for="am">上午場（150元）</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="pm" value="yes" id="pm">
        <label class="form-check-label" for="pm">下午場（100元）</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="lunch" value="yes" id="lunch">
        <label class="form-check-label" for="lunch">午餐（50元）</label>
      </div>
    </div>

    <input type="hidden" name="event" value="camp">
    <button type="submit" class="btn btn-success w-100">送出報名</button>
  </form>
</div>

<?php include 'footer.php'; ?>
