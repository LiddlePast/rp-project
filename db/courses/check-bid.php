<?php
require_once __DIR__ . "/../config.php";

$user = $_SESSION['user_id'] ?? null;
$currentCourse = $_GET['course'] ?? null;
$isAvailable = true;

$stmt = $pdo->prepare("SELECT `user_id`, `course_id` FROM `bids` WHERE `user_id` = ? AND `course_id` = ?");
$stmt->execute([$user, $currentCourse]);

$data = $stmt->fetch();

if ($data) {
  $isAvailable = false;
} else {
  $isAvailable = true;
}