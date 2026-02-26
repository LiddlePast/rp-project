<?php
require_once __DIR__ . "/../config.php";

$stmt = $pdo->query("SELECT * FROM courses ORDER BY course_id DESC");
$courses = $stmt->fetchAll();
