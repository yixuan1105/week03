<?php
// week03/header.php
session_start(); // ✅ 必須放在最前面，才能使用 $_SESSION

$pageTitle = $pageTitle ?? "活動報名系統"; // 如果頁面有設定 $pageTitle，就使用它；否則預設為「活動報名系統」

function nav_active($file) {
  $current = basename($_SERVER['PHP_SELF']);
  return $current === $file ? ' active' : '';
}
$logged = isset($_SESSION["name"]);
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title> <!-- 安全顯示網頁標題 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="custom.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg custom-bg">
  <div class="container">
    <a class="navbar-brand" href="index.php">活動報名系統</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link<?= nav_active('index.php') ?>" href="index.php">首頁</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= nav_active('status.php') ?>" href="status.php">迎新茶會</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= nav_active('conference.php') ?>" href="conference.php">資管一日營</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= nav_active('job.php') ?>" href="job.php">求才資訊</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <?php if (isset($_SESSION['name'])): ?>
          <li class="nav-item">
            <span class="nav-link text-white">歡迎，<?= htmlspecialchars($_SESSION['name']) ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signout.php">登出</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php?redirect=<?= urlencode($_SERVER["REQUEST_URI"]) ?>">登入</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
