<?php
include 'header.php'; // header 裡面已經有 session_start()

// 使用者資料（帳號、密碼、姓名、身分）
$users = [
  ["account" => "root",  "password" => "password", "name" => "yixuan", "role" => "teacher"],
  ["account" => "413401039", "password" => "pw1", "name" => "包子姊姊",   "role" => "student"],
  ["account" => "413401040", "password" => "pw2", "name" => "木箱哥哥",   "role" => "student"],
];

// ====== 表單送出處理 ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $account  = $_POST['account'] ?? '';
  $password = $_POST['password'] ?? '';
  $redirect = $_POST['redirect'] ?? 'index.php';
  $found = false;

  foreach ($users as $user) {
    if ($user["account"] === $account && $user['password'] === $password) {
      // ✅ 登入成功：把整個使用者資料放進 session
      $_SESSION['name'] = $user["name"];
      $_SESSION["role"] = $user["role"];
      $found = true;

      // ✅ 登入後回到原本想進的頁面
      header("Location: $redirect");
      exit;
    }
  }

  // ❌ 登入失敗：回登入頁並顯示錯誤訊息
  if (!$found) {
    header("Location: login.php?msg=帳號或密碼錯誤&redirect=" . urlencode($redirect) . "&account=" . urlencode($account));
    exit;
  }
}

// ====== 顯示登入畫面 ======
$msg          = $_GET['msg'] ?? '';
$redirect     = $_GET['redirect'] ?? ($_SERVER["HTTP_REFERER"] ?? 'index.php');
$accountValue = $_GET['account'] ?? '';
?>

<div class="container py-5" style="max-width: 500px;">
  <h2 class="mb-4 text-center">登入</h2>

  <form method="post" action="login.php">
    <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">

    <div class="mb-3">
      <label for="account" class="form-label">帳號</label>
      <input type="text" class="form-control" id="account" name="account"
             value="<?= htmlspecialchars($accountValue) ?>" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">密碼</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">登入</button>
  </form>

  <?php if ($msg): ?>
    <div class="alert alert-danger mt-3 text-center"><?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
