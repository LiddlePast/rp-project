<?php
require_once __DIR__ . "/../db/config.php";
/* 
  user_name,
  course_name,
  bid_status,
  bid_created_at,
*/
$stmt = $pdo->query("
SELECT
    b.bid_id,
    b.course_id AS bid_courseid,
    c.name AS course_name,
    b.user_id AS bid_userid,
    b.status AS bid_status,
    b.created_at AS bid_created_at,
    c.course_id AS courses_courseid,
    u.user_id AS users_userid,
    u.login AS users_userlogin
  FROM bids AS b
  JOIN courses AS c
    ON b.course_id = c.course_id
  JOIN users AS u
    ON b.user_id = u.user_id
");
$bids = $stmt->fetchAll();
?>

<div class="control__bids">
  <?php if ($bids && count($bids) > 0): ?>
    <table class="bids__list">
      <thead>
        <tr>
          <th>#</th>
          <th>Курс</th>
          <th>Пользователь</th>
          <th>Дата создания заявки</th>
          <th>Статус</th>
          <th>Управление</th>
        </tr>
      </thead>
      <tbody>
        <?php
          for ($i = 0; $i < count($bids); $i++) {
            $row = "<tr>";
            $row .= "<td>".$bids[$i]['bid_id']."</td>";
            $row .= "<td>".$bids[$i]['course_name']."</td>";
            $row .= "<td>".$bids[$i]['users_userlogin']."</td>";
            $row .= "<td>".$bids[$i]['bid_created_at']."</td>";
             $row .= "<td>". ($bids[$i]['bid_status'] === 'new' ? 'Новая' : ($bids[$i]['bid_status'] === 'in_process' ? 'В обработке' : 'Завершена')) ."</td>";
            $row .= "<td><a href='edit_bid.php?bid=".$bids[$i]['bid_id']."'>Изменить</a></td>";
            $row .= "</tr>";
            echo $row;
          }
        ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Заявок нет</p>
  <?php endif; ?>
</div>