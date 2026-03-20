<?php
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') {
  header("Location: /profile.php");
  exit;
} elseif (!isset($_SESSION['user_role'])) {
  header("Location: /login.php");
  exit;
}
$course_id = $_GET['course'] ?? null;
if (!$course_id) {
  header("Location: /admin/dashboard.php");
  exit;
}
require_once __DIR__ . "/../db/config.php";
$stmt = $pdo->prepare("SELECT course_id, name, description, price, dates, created_at, status FROM courses WHERE course_id = ? LIMIT 1");
$stmt->execute([$course_id]);
$course_data = $stmt->fetch();
if (!$course_data) {
  header("Location: /admin/dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php require_once __DIR__ . "/../components/header.php" ?>
  <!-- ИЛИ -->
  <a href="/admin/dashboard.php">Назад</a>
  <?php print_r($course_data) ?>
</body>

</html>