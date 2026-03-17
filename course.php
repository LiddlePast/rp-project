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
    <?php echo "<pre>";print_r($course_data);echo "</pre>"; ?>
    <?php echo "<pre>"; ($reviews) ? print_r($reviews) : print_r('Нет отзывов'); echo "</pre>"; ?>
    <?php require_once "db/courses/check-bid.php"; ?>
    <?php if($isAvailable): ?>
    <form action="db/bids/create.php" method="post">
        <?php if (isset($_SESSION['user_login'])): ?>
            <input type="hidden" name="user" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
        <?php endif; ?>
        <input type="hidden" name="course" value="<?= htmlspecialchars($course_data['course_id']) ?>">
        <button type="submit">Записаться на курс</button>
    </form>
    <?php else: echo "<p>Вы записаны на курс</p>"; endif; ?>
</body>

</html>