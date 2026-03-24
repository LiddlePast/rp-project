<?php
session_start();

$course_id = $_POST['course_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;
$content = $_POST['review'] ?? null;

if (!isset($course_id) || empty($course_id)) {
  header("Location: /course.php?course=$course_id");
  exit;
}

if (!isset($user_id) || empty($user_id)) {
  header("Location: /login.php");
  exit;
}

if (!isset($content) || empty($content)) {
  header("Location: /course.php?course=$course_id");
  exit;
}

require_once __DIR__ . "/../config.php";
$stmt = $pdo->prepare("INSERT INTO reviews (course_id, user_id, content) values (?, ?, ?)");

try {
  $stmt->execute([$course_id, $user_id, $content]);
  header("Location: /course.php?course=$course_id");
  exit;
} catch (PDOException $ex) {
  header("Location: /course.php?course=$course_id");
  exit;
}




