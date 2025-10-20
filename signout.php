<?php
session_start(); // 啟用 session，才能清除登入資料

session_destroy(); // ✅ 清除所有 session 資料，登出成功

header("Location: index.php"); // ✅ 登出後導回首頁
exit; // ✅ 結束程式，避免後續執行
?>
