<?php
session_start();
if (isset($_SESSION['user_login']) && $_SESSION['user_login'] != '') {
    header('Location: /index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вход</title>
</head>
<body>
  <?php require_once "components/header.php" ?>
  <main class="main">
    <div class="container">
      <form action="/auth/login.php" method="post">
        <div class="form-item">
          <label for="login" class="form__label">Логин</label>
          <input type="text" class="form__input" id="login" name="login" required value="<?= isset($_SESSION['input']['login']) ? $_SESSION['input']['login'] : '' ?>">
          <small><?= isset($_SESSION['errors']['login']) ? $_SESSION['errors']['login'] : '' ?></small>
        </div>
        <div class="form-item">
          <label for="password" class="form__label">Пароль</label>
          <input type="password" class="form__input" id="password" name="password" required minlength="8">
          <small><?= isset($_SESSION['errors']['password']) ? $_SESSION['errors']['password'] : '' ?></small>
        </div>
        <button type="submit">Войти</button>
      </form>
      <?php unset($_SESSION['errors'], $_SESSION['input']); ?>
    </div>
  </main>
</body>
</html>