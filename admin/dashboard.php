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
  <?php 
  if (isset($_SESSION['errors'])):
  ?>
  <div class="alerts">
    <ul class="alerts__list">
    <?php foreach ($_SESSION['errors'] as $error): ?>
      <li class="alerts__item"><?= $error ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
  <?php
  unset($_SESSION['errors']);
  endif;
  ?>
  <?php if (isset($_SESSION['query_success'])): ?>
    <ul class="status">
      <li><?= $_SESSION['query_success'] ?></li>
    </ul>
  <?php unset($_SESSION['query_success']); endif; ?>
  <?php if (isset($_SESSION['query_error'])): ?>
    <ul class="status">
      <li><?= $_SESSION['query_error'] ?></li>
    </ul>
  <?php unset($_SESSION['query_error']); endif; ?>
  <main class="main">
    <div class="control">
      <?php require_once "./create_course.php" ?>
      <?php require_once "./courses.php" ?>
      <?php require_once "./bids.php" ?>
    </div>
  </main>
</body>
</html>