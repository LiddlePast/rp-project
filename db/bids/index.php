<?php
$user = $_SESSION['user_id'] ?? null;
require_once __DIR__ . "/../config.php";

$stmt = $pdo->prepare("SELECT c.course_id, c.name, c.description, c.dates, b.bid_id, b.user_id, b.course_id AS course, b.status FROM bids AS b LEFT JOIN courses AS c ON b.user_id = ? AND c.course_id = b.course_id WHERE b.user_id = ? ORDER BY c.dates DESC");
$stmt->execute([$user, $user]);

$data = $stmt->fetchAll();
