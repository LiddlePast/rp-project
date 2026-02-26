<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Курсы</title>
</head>
<body>
<?php require_once "components/header.php" ?>
<main class="main">
    <div class="container">
        <?php require_once "db/courses/index.php" ?>
        <?php
        foreach ($courses as $course) {
            echo "<a href='course.php?course={$course['course_id']}' style='display: block;'>";
            $div = "<div class='course'>";
            $div .= "<div class='course__name'><span>{$course['name']}</span></div>";
            $div .= "<div class='course__description'><span>{$course['description']}</span></div>";
            $div .= "<div class='course__info'><div class='course__price'><span>{$course['price']} Р.</span></div><div class='course__date'><span>{$course['dates']}</span></div></div>";
            $div .= "</div>";
            echo $div;
            echo "</a>";
        }
        ?>
    </div>
</main>
</body>
</html>