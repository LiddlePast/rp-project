<?php
session_start();
require_once "db/courses/show.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $course_data['name'] ?></title>
</head>

<body>
    <?php require_once "components/header.php"; ?>
    <h1><?= $course_data['name'] ?></h1>
    <p><?= $course_data['description'] ?></p>
    <p><?= $course_data['price'] ?></p>
    <p><?= $course_data['dates'] ?></p>

    <?php require_once "db/courses/check-bid.php"; ?>
    <?php if($_SESSION['user_role'] !== 'admin'): ?>
    <?php if($isAvailable): ?>
    <form action="db/bids/create.php" method="post">
        <?php if (isset($_SESSION['user_login'])): ?>
            <input type="hidden" name="user" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
        <?php endif; ?>
        <input type="hidden" name="course" value="<?= htmlspecialchars($course_data['course_id']) ?>">
        <button type="submit">Записаться на курс</button>
    </form>
    <?php else: echo "<p>Вы записаны на курс</p>"; endif; ?>
    <?php endif; ?>
    <?php 
        if ($reviews && count($reviews) > 0) {
            echo "<div class='reviews'>";
            for ($i = 0; $i < count($reviews); $i++) {
                $review = "<div class='review'>";
                $review .= "<div class='review__login'>".$reviews[$i]['login']."</div>";
                $review .= "<div class='review__content'>".$reviews[$i]['content']."</div>";
                $review .= "<div class='review__date'>".$reviews[$i]['date']."</div>";
                $review .= "</div><hr>";
                echo $review;
            }
            echo "</div>";
        } else {
            echo "<p>Отзывов пока нет</p>";
        }
    ?>
</body>

</html>