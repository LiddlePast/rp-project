<?php
require_once __DIR__ . "/../config.php";

$stmt = $pdo->query("SELECT * FROM courses WHERE deleted_at IS NULL ORDER BY course_id DESC");
$courses = $stmt->fetchAll();
