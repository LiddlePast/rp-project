<?php
session_start();
if ($_SESSION['user_role'] === 'admin') {
  $name = $_POST['name'] ?? "";
  $desc = $_POST['desc'] ?? "";
  $price = $_POST['price'] ?? "";
  $dates = $_POST['dates'] ?? "";

  $errors = [];
  if (!isset($name) || empty($name)) {
    $errors['name'] = "Введите название курса";
  }
  if (!isset($desc) || empty($desc)) {
    $errors['desc'] = "Не указано описание курса";
  }
  if (!isset($price) || empty($price)) {
    $errors['price'] = "Введите цену курса";
  } elseif ($price < 0) {
    $errors['price'] = "Цена не может быть меньше 0";
  }
  if (!isset($dates) || empty($dates)) {
    $errors['dates'] = "Укажите дату";
  }

  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: https://rp1/admin/dashboard.php");
    exit;
  }
  
  require_once __DIR__ . "/../db/config.php";
  $stmt = $pdo->prepare("INSERT INTO courses SET name = ?, description = ?, price = ?, dates = ?");
  try {
    $stmt->execute([$name, $desc, $price, $dates]);
    $_SESSION['query_success'] = "Запись создана";
    header("Location: https://rp1/admin/dashboard.php");
    exit;
  } catch (PDOException $ex) {
    $_SESSION['query_error'] = "Ошибка создания записи";
    header("Location: https://rp1/admin/dashboard.php");
    exit;
  }
}