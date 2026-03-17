<?php
$course = (int)($_GET["course"] ?? 0);

require_once __DIR__ . "/../config.php";

$stmt = $pdo->prepare("SELECT * FROM courses WHERE course_id = ? LIMIT 1");
$stmt->execute([$course]);

if ($course_data = $stmt->fetch()) {
    $stmt = $pdo->prepare("
SELECT r.review_id, r.course_id, r.user_id, r.content, c.name, c.description, u.login, r.created_at AS date 
FROM reviews AS r
JOIN courses AS c ON r.course_id = c.course_id
JOIN users AS u ON r.user_id = u.user_id
WHERE r.course_id = ?");
    $stmt->execute([$course]);
    if ($reviews_data = $stmt->fetchAll()) {
        $reviews = $reviews_data;
    } else {
        $reviews = null;
    }
} else {
    http_response_code(404);
    include "404.php";
    exit;
}
