<?php
session_start();

if ((isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') || empty($_SESSION['user_role'])) {
  header("Location: /login.php");
  exit;
}

$bid_id = $_POST['bid'] ?? null;
$course = $_POST['courses'] ?? null;
$status = $_POST['status'] ?? null;

if (!isset($bid_id) || empty($bid_id)) {
  header("Location: /admin/dashboard.php");
  exit;
}

if (!isset($course) || empty($course)) {
  header("Location: /admin/edit_bid.php?bid=$bid_id");
  exit;
}

if (!isset($status) || empty($status)) {
  header("Location: /admin/edit_bid.php?bid=$bid_id");
  exit;
}

require_once __DIR__ . "/../db/config.php";
$stmt = $pdo->prepare("UPDATE bids SET course_id = ?, status = ? WHERE bid_id = ?");
try {
  $stmt->execute([$course, $status, $bid_id]);
  header("Location: /admin/edit_bid.php?bid=$bid_id");
  exit;
} catch (PDOException $ex) {
  header("Location: /admin/edit_bid.php?bid=$bid_id");
  exit;
}