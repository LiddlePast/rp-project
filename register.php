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
      <form action="" method="post">
        <div class="form-item">
          <label for="login" class="form__label">Логин</label>
          <input type="text" class="form__input" id="login" name="login">
        </div>
        <div class="form-item">
          <label for="email" class="form__label">Email</label>
          <input type="email" class="form__input" id="email" name="email">
        </div>
        <div class="form-item">
          <label for="password" class="form__label">Пароль</label>
          <input type="password" class="form__input" id="password" name="password">
        </div>
        <div class="form-item">
          <label for="password_confirm" class="form__label">Повторите пароль</label>
          <input type="password" class="form__input" id="password_confirm" name="password_confirm">
        </div>
        <button type="submit">Зарегистрироваться</button>
      </form>
    </div>
  </main>
</body>

</html>