<?php
require_once __DIR__ . "/../db/config.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $login = mb_trim($_POST['login'] ?? '');
  $password = $_POST['password'];

  $errors = [];

  if (mb_strlen($login) <= 3) {
    $errors['login'] = 'Логин должен быть длиной от 4 символов';
  }

  if (mb_strlen($password) < 8) {
    $errors['password'] = 'Пароль минимум 8 символов';
  }
  
  if (count($errors) > 0) {
    session_start();
    $_SESSION['errors'] = $errors;
    $_SESSION['input']['login'] = $login;
    header("Location: /login.php");
    exit;
  }

  $stmt = $pdo->prepare("SELECT user_id, email, login, password FROM users WHERE login = ?");
  $stmt->execute([$login]);
  if ($stmt->fetch()) {
    // ... ИЗМЕНИТЬ
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
