<?php
session_start();
if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] == '') {
  header("Location: /login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Профиль</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
  <?php require_once "components/header.php" ?>
  <main class="main">
    <div class="main__inner">
      <div class="user-data">
        <p><?= htmlspecialchars($_SESSION['user_login']) ?></p>
        <p>Email: <?= htmlspecialchars($_SESSION['user_email']) ?></p>
      </div>
      <div class="courses">
        <?php
          require_once "db/bids/index.php";
          for ($i = 0; $i < count($data); $i++) {
            $card = "<div class='card'>";
            $card .= "<div class='name'>".$data[$i]['name']."</div>";
            $card .= "<div class='desc'>".$data[$i]['description']."</div>";
            $card .= "<div class='controls'>";
            $card .= "<span class='data'>".$data[$i]['dates']."</span><span class='status' style='padding: 2px 5px; border: 1px solid skyblue; border-radius: 10px;'>".($data[$i]['status'] == 'new' ? 'новый' : 'в работе' )."</span>";
            $card .= "</div>";
            $card .= "</div>";
            echo $card;
          }
        ?>
      </div>
    </div>
  </main>
</body>
</html>