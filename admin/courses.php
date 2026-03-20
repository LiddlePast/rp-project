<?php
require_once __DIR__ . "/../db/config.php";
$stmt = $pdo->query("SELECT course_id, name, description, price, dates, status FROM courses ORDER BY course_id");
$courses = $stmt->fetchAll();
?>

<div class="control__courses">
  <?php if ($courses && count($courses) > 0): ?>
  <table class="courses__list">
    <thead>
      <tr>
        <th>#</th>
        <th>Наименование</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Даты</th>
        <th>Состояние</th>
        <th>Управление</th>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i = 0; $i < count($courses); $i++) {
          $row = "<tr>";
          $row .= "<td>".$courses[$i]['course_id']."</td>";
          $row .= "<td>".$courses[$i]['name']."</td>";
          $row .= "<td>".$courses[$i]['description']."</td>";
          $row .= "<td>".$courses[$i]['price']."</td>";
          $row .= "<td>".$courses[$i]['dates']."</td>";
          $row .= "<td>". ($courses[$i]['status'] === 'prepared' ? 'Готов' : ($courses[$i]['status'] === 'in_progress' ? 'В процессе' : 'Завершён')) ."</td>";
          $row .= "<td><a href='edit.php?course=".$courses[$i]['course_id']."'>Изменить</a></td>";
          $row .= "</tr>";
          echo $row;
        }
      ?>
    </tbody>
  </table>
  <?php else: ?>
  <p>Курсов нет</p>
  <?php endif; ?>
</div>