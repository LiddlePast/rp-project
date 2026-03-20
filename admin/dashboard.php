<?php
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') {
  header("Location: /profile.php");
  exit;
} elseif (!isset($_SESSION['user_role'])) {
  header("Location: /login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>
<body>
  <?php require_once __DIR__ . "/../components/header.php" ?>
  <main class="main">
    <div class="control">
      <?php require_once "./courses.php" ?>
    </div>
  </main>
</body>
</html>