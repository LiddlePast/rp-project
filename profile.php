<?php
session_start();
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] == '') {
  header("Location: /login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Профиль</title>
</head>
<body>
  <?php require_once "components/header.php" ?>
  <p><?= htmlspecialchars($_SESSION['user_login']) ?></p>
</body>
</html>