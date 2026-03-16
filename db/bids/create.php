<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $course = (int)($_POST['course'] ?? null);
  $user = (int)($_POST['user'] ?? null);

  require_once __DIR__ . "/../config.php";
  $stmt = $pdo->prepare("INSERT INTO `bids` (`user_id`, `course_id`) VALUES (?, ?)");
  try {
    $stmt->execute([$user, $course]);
    header("Location: /profile.php");
    exit;
  } catch (PDOException $ex) {
    $referer = getallheaders()['Referer'];
    header("Location: $referer");
    exit;
  }

  if (!$user) {
    header("Location: /login.php");
    exit;
  }
}