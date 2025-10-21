<?php
include 'header.php'; // header 裡面已有 session_start()
require_once 'db.php'; // ✅ 資料庫連線 ($conn)

// ====== 表單送出處理 ======
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 取得使用者輸入
  $account  = $_POST['account'] ?? '';
  $password = $_POST['password'] ?? '';
  $redirect = $_POST['redirect'] ?? 'index.php';

  // 檢查空值
  if ($account === '' || $password === '') {
    header("Location: login.php?msg=" . urlencode("請輸入帳號與密碼") .
           "&redirect=" . urlencode($redirect) .
           "&account=" . urlencode($account));
    exit;
  }

  // ✅ 防止 SQL Injection：使用 mysqli_real_escape_string()
  $account  = mysqli_real_escape_string($conn, $account);
  $password = mysqli_real_escape_string($conn, $password);

  // ✅ 查詢資料庫（作業提供的 SQL）
  $sql = "SELECT * FROM user WHERE account = '$account'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // 檢查密碼是否正確
    if ($row['password'] === $password) {
      // 登入成功 → 寫入 Session
      $_SESSION['account'] = $row['account'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['role'] = $row['role'];

      header("Location: $redirect");
      exit;
    } else {
      // 密碼錯誤
      header("Location: login.php?msg=" . urlencode("密碼錯誤") .
             "&redirect=" . urlencode($redirect) .
             "&account=" . urlencode($account));
      exit;
    }
  } else {
    // 查無帳號
    header("Location: login.php?msg=" . urlencode("查無此帳號") .
           "&redirect=" . urlencode($redirect) .
           "&account=" . urlencode($account));
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
