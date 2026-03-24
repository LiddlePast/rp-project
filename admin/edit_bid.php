<?php
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') {
  header("Location: /profile.php");
  exit;
} elseif (!isset($_SESSION['user_role'])) {
  header("Location: /login.php");
  exit;
}
$bid_id = $_GET['bid'] ?? null;
if (!$bid_id) {
  header("Location: /admin/dashboard.php");
  exit;
}
require_once __DIR__ . "/../db/config.php";
$courses_list = $pdo->query("SELECT * FROM courses");
$courses_list = $courses_list->fetchAll();

$user_data = $pdo->prepare("
SELECT 
  bids.bid_id,
  bids.user_id,
  bids.course_id,
  bids.status,
  users.login
FROM bids
JOIN users ON bids.user_id = users.user_id
WHERE bids.bid_id = ?
");
$user_data->execute([$bid_id]);
$user_data = $user_data->fetch();

if (!$courses_list) {
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
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <?php require_once __DIR__ . "/../components/header.php" ?>
  <a href="/admin/dashboard.php">Назад</a>
  <hr>
  <!-- course_id, name, descrirtion, price, dates, status -->
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
  <p>Изменить данные о заявке пользователя: <?= $user_data['login'] ?></p>
  <form action="update_bid.php" method="post">
    <input type="hidden" name="bid" value="<?= $user_data['bid_id'] ?>">
    <label for="courses">Курс</label>
    <select name="courses" id="courses">
      <?php for ($i = 0; $i < count($courses_list); $i++): ?>
      <option value="<?= $courses_list[$i]['course_id'] ?>" <?= ($user_data['course_id'] == $courses_list[$i]['course_id']) ? 'selected' : '' ?>><?= $courses_list[$i]['name'] ?></option>
      <?php endfor; ?>
    </select>
    <select name="status" id="status">
      <option value="new" <?= ($user_data['status'] == 'new') ? 'selected' : '' ?>>Новая</option>
      <option value="in_process" <?= ($user_data['status'] == 'in_process') ? 'selected' : '' ?>>В обработке</option>
      <option value="done" <?= ($user_data['status'] == 'done') ? 'selected' : '' ?>>Завершён</option>
    </select>
    <button type="submit">Изменить данные</button>
  </form>