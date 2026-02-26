<?php
$course = (int)($_GET["course"] ?? 0);

require_once __DIR__ . "/../config.php";

$stmt = $pdo->prepare("SELECT * FROM courses WHERE course_id = ? LIMIT 1");
$stmt->execute([$course]);

if ($course = $stmt->fetch()) {

} else {
    http_response_code(404);
    include "404.php";
    exit;
}
