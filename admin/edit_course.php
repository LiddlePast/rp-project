<?php
session_start();
if ($_SESSION['user_role'] === 'admin') {
  $course_id = $_POST['course'] ?? "";
  $name = $_POST['name'] ?? "";
  $desc = $_POST['desc'] ?? "";
  $price = $_POST['price'] ?? "";
  $dates = $_POST['dates'] ?? "";
  $status = $_POST['status'] ?? "";

  $errors = [];

  if (!isset($course_id) || empty($course_id)) {
    $errors['course'] = "Не указан курс";
  }
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
  if (!isset($status) || empty($status)) {
    $errors['dates'] = "Выберите статус";
  }

  if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: https://rp1/admin/edit.php?course=$course_id");
    exit;
  }
  
  require_once __DIR__ . "/../db/config.php";
  $stmt = $pdo->prepare("UPDATE courses SET name = ?, description = ?, price = ?, dates = ?, status = ? WHERE course_id = ?");
  try {
    $stmt->execute([$name, $desc, $price, $dates, $status, $course_id]);
    $_SESSION['query_success'] = "Запись обновлена";
    header("Location: https://rp1/admin/dashboard.php");
    exit;
  } catch (PDOException $ex) {
    $_SESSION['query_error'] = "Ошибка обновления записи";
    header("Location: https://rp1/admin/dashboard.php");
    exit;
  }
}