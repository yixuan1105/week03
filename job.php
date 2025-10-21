<?php
require_once "header.php";
try {
  require_once 'db.php';
  $sql="SELECT * FROM job";
  $result = mysqli_query($conn, $sql);
?>
<form action="query.php" method="post" class="mb-3">
  <select name="order" aria-label="選擇排序欄位">
    <option selected value="">選擇排序欄位</option>
    <option value="company">求才廠商</option>
    <option value="content">求才內容</option>
    <option value="pdate">刊登日期</option>
  </select>
  <input placeholder="搜尋廠商及內容" type="text" name="searchtxt">
  <input class="btn btn-primary" type="submit" value="搜尋">
</form>

<div class="container">
  <table id="jobTable" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>求才廠商</th>
        <th>求才內容</th>
        <th>刊登日期</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= htmlspecialchars($row["company"]) ?></td>
        <td><?= htmlspecialchars($row["content"]) ?></td>
        <td><?= htmlspecialchars($row["pdate"]) ?></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<?php
  mysqli_close($conn);
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}
require_once "footer.php";
?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables 初始化 -->
<script>
$(document).ready(function() {
  $('#jobTable').DataTable({
    // 載入繁體中文介面
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/zh-HANT.json"
    },
    pageLength: 10,   // 每頁顯示 10 筆
    ordering: true,   // 啟用排序
    searching: true   // 啟用搜尋
  });
});
</script>
