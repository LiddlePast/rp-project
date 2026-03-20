<?php
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') {
  header("Location: /profile.php");
  exit;
} elseif (!isset($_SESSION['user_role'])) {
  header("Location: /login.php");
  exit;
}
$course_id = $_GET['course'] ?? null;
if (!$course_id) {
  header("Location: /admin/dashboard.php");
  exit;
}
require_once __DIR__ . "/../db/config.php";
$stmt = $pdo->prepare("SELECT course_id, name, description, price, dates, created_at, status FROM courses WHERE course_id = ? LIMIT 1");
$stmt->execute([$course_id]);
$course_data = $stmt->fetch();
if (!$course_data) {
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
  <form action="edit_course.php" method="post">
    <input type="hidden" name="course" value="<?= $course_data['course_id'] ?>">
    <div class="form-edit__item">
      <label for="name" class="form-edit__label">Наименование курса</label>
      <input type="text" class="form-edit__input" id="name" name="name" value="<?= $course_data['name'] ?>">
    </div>
    <div class="form-edit__item">
      <label for="desc" class="form-edit__label">Описание</label>
      <textarea class="form-edit__input" name="desc" id="desc"><?= $course_data['description'] ?></textarea>
    </div>
    <div class="form-edit__item">
      <label for="price" class="form-edit__label">Стоимость</label>
      <input type="number" step="0.01" class="form-edit__input" name="price" id="price" value="<?= $course_data['price'] ?>">
    </div>
    <div class="form-edit__item">
      <label for="dates" class="form-edit__label">Дата начала</label>
      <input type="datetime-local" class="form-edit__input" name="dates" id="dates"  value="<?= $course_data['dates'] ?>">
    </div>
    <div class="form-edit__item">
      <label for="status" class="form-edit__label">Состояние</label>
      <select name="status" id="status">
        <option value="prepared" <?= $course_data['status'] == 'prepared' ? 'selected=true' : '' ?>>Подготовлен</option>
        <option value="in_progress" <?= $course_data['status'] == 'in_progress' ? 'selected=true' : '' ?>>В процессе</option>
        <option value="ended" <?= $course_data['status'] == 'ended' ? 'selected=true' : '' ?>>Завершён</option>
      </select>
    </div>
    <button type="submit">Изменить</button>
  </form>

  <form action="delete_course" method="post">
    <input type="hidden" name="course" value="<?= $course_data['course_id'] ?>">
    <button type="submit">❌</button>
  </form>
  <script>
    const DELETE_FORM = document.forms[2];

    async function deleteData(course_id) {
      const response = await fetch("https://rp1/admin/delete_course.php", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          course: course_id
        })
      });
      return await response.json();
    }

    DELETE_FORM.addEventListener('submit', (e) => {
      e.preventDefault();
      let deleteRow = confirm("Удалить запись?");
      const course_id = DELETE_FORM.children[0].value;
      if (deleteRow) {
        deleteData(course_id)
          .then(res => {
            console.log(res)
            if (res.success) {
              document.location.href = "https://rp1/admin/dashboard.php";
            }
          })
          .catch(err => console.log(err))
      } else {
        return;
      }
    })
  </script>
</body>

</html>