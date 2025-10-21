<?php
include 'header.php';

$account  = $_POST['account'] ?? '';
$password = $_POST['password'] ?? '';
$redirect = $_POST['redirect'] ?? 'index.php';

// ✅ 連接資料庫
$conn = new mysqli('localhost', 'root', '', 'practice');
if ($conn->connect_error) {
  die("連線失敗：" . $conn->connect_error);
}

// ✅ 查詢帳號
$sql = "SELECT account, password, name, role FROM user WHERE account = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $account);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  if ($row['password'] === $password) {
    $_SESSION['account'] = $row['account'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['role'] = $row['role'];
    header("Location: $redirect");
    exit;
  }
}

// ❌ 登入失敗
header("Location: login.php?msg=帳號或密碼錯誤&redirect=" . urlencode($redirect) . "&account=" . urlencode($account));
exit;
?>
