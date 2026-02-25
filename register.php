<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация</title>
</head>

<body>
  <?php require_once "components/header.php" ?>
  <main class="main">
    <div class="container">
      <form action="/auth/register.php" method="post">
        <div class="form-item">
          <label for="login" class="form__label">Логин</label>
          <input type="text" class="form__input" id="login" name="login" required value="<?= isset($_SESSION['input']['login']) ? $_SESSION['input']['login'] : '' ?>">
          <small><?= isset($_SESSION['errors']['login']) ? $_SESSION['errors']['login'] : '' ?></small>
        </div>
        <div class="form-item">
          <label for="email" class="form__label">Email</label>
          <input type="email" class="form__input" id="email" name="email" required value="<?= isset($_SESSION['input']['email']) ? $_SESSION['input']['email'] : '' ?>">
          <small><?= isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : '' ?></small>
        </div>
        <div class="form-item">
          <label for="password" class="form__label">Пароль</label>
          <input type="password" class="form__input" id="password" name="password" required minlength="8">
          <small><?= isset($_SESSION['errors']['password']) ? $_SESSION['errors']['password'] : '' ?></small>
        </div>
        <div class="form-item">
          <label for="password_confirm" class="form__label">Повторите пароль</label>
          <input type="password" class="form__input" id="password_confirm" name="password_confirm" required minlength="8">
          <small><?= isset($_SESSION['errors']['password_confirm']) ? $_SESSION['errors']['password_confirm'] : '' ?></small>
        </div>
        <button type="submit">Зарегистрироваться</button>
      </form>
      <?php unset($_SESSION['errors'], $_SESSION['input']); ?>
    </div>
  </main>
</body>

</html>