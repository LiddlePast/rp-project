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
    <title><?= $course['name'] ?></title>
</head>

<body>
    <?php require_once "components/header.php"; ?>
    <?php print_r($course); ?>
    <form action="db/bids/create.php" method="post">
        <?php if (isset($_SESSION['user_login'])): ?>
            <input type="hidden" name="user" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
        <?php endif; ?>
        <input type="hidden" name="course" value="<?= htmlspecialchars($course['course_id']) ?>">
        <button type="submit">Записаться на курс</button>
    </form>

</body>

</html>