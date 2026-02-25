<?php
require_once __DIR__ . "/../db/config.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $login = mb_trim($_POST['login'] ?? '');
  $email = mb_trim($_POST['email'] ?? '');
  $password = $_POST['password'];
  $password_confirm = $_POST['password_confirm'];

  $errors = [];

  if (mb_strlen($login) <= 3) {
    $errors['login'] = 'Логин должен быть длиной от 4 символов';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
  }

  if (mb_strlen($password) < 8 || !preg_match('/[A-Z0-9]+/u', $password, $matches)) {
    $errors['password'] = 'Пароль минимум 8 символов и должен содержать цифру или заглавную';
  }

  if (mb_strlen($password_confirm) < 8) {
    $errors['password_confirm'] = 'Пароль минимум 8 символов';
  }

  if ($password !== $password_confirm) {
    $errors["password"] = "Пароли не совпадают";
  }
  
  if (count($errors) > 0) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['input']['login'] = $login;
    $_SESSION['input']['email'] = $email;
    header("Location: /register.php");
    exit;
  }

  $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ? OR login = ?");
  $stmt->execute([$email, $login]);
  if ($stmt->fetch()) {
    session_start();
    $_SESSION['errors']['login'] = "Логин или email занят";
    header("Location: /register.php");
    exit;
  }
  try {
    $stmt = $pdo->prepare("INSERT INTO users (email, login, password) VALUES (?, ?, ?)");
    $stmt->execute([$email, $login, password_hash($password, PASSWORD_DEFAULT)]);
    $userId = $pdo->lastInsertId();
    session_start();
    session_regenerate_id();
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_login'] = $login;
    $_SESSION['user_role'] = 'user';
    header("Location: /index.php");
    exit;
  } catch (PDOException $ex) {
    session_start();
    $_SESSION['errors']['login'] = $ex->getMessage();
    header("Location: /register.php");
    exit;
  }
}
