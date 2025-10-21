<?php
require_once "header.php";
require_once 'db.php';

// 取得表單輸入
$order = $_POST["order"] ?? "";
$searchtxt = $_POST["searchtxt"] ?? "";

// 防止 SQL Injection
$order = mysqli_real_escape_string($conn, $order);
$searchtxt = mysqli_real_escape_string($conn, $searchtxt);

// 建立查詢 SQL
$sql = "SELECT * FROM job WHERE 1";

if (!empty($searchtxt)) {
  $sql .= " AND (company LIKE '%$searchtxt%' OR content LIKE '%$searchtxt%')";
}

if (!empty($order)) {
  $sql .= " ORDER BY $order";
}

$result = mysqli_query($conn, $sql);
?>

<!-- ===== 搜尋與排序表單 ===== -->
<form method="post" class="mb-3">
  <select name="order" aria-label="選擇排序欄位" class="form-select d-inline-block w-auto">
    <option selected value="">選擇排序欄位</option>
    <option value="company" <?= $order=='company'?'selected':'' ?>>求才廠商</option>
    <option value="content" <?= $order=='content'?'selected':'' ?>>求才內容</option>
    <option value="pdate" <?= $order=='pdate'?'selected':'' ?>>刊登日期</option>
  </select>

  <input type="text" name="searchtxt" placeholder="搜尋廠商及內容"
         class="form-control d-inline-block w-auto" style="width:250px;"
         value="<?= htmlspecialchars($searchtxt) ?>">

  <input class="btn btn-primary" type="submit" value="搜尋">
</form>

<!-- ===== 資料表格 ===== -->
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
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/zh-HANT.json"
    },
    pageLength: 10,
    ordering: true,
    searching: true
  });
});
</script>
