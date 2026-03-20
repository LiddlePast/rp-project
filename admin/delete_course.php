<?php
header("Access-Control-Allow-Origin: https://rp1");
// Разрешили домену отправлять сюда сетевые запросы
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
// OPTIONS - Проверка разрешения на считывание
header("Access-Control-Allow-Headers: Content-Type");
// Разрешить заголовки
header("Content-Type: application/json");
// Формат ответа

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$course_id = $input['course'] ?? null;

require_once __DIR__ . "/../db/config.php";
$stmt = $pdo->prepare("UPDATE courses SET deleted_at = ? WHERE course_id = ?");
try {
  $stmt->execute([date('Y-m-d H:i:s'), $course_id]);
  echo json_encode([
    'success' => 'Курс удален'
  ]);
  exit;
} catch (PDOException $ex) {
  echo json_encode([
    'error' => 'Ошибка удаления курса'
  ]);
  exit;
}

if (!$course_id) {
  echo json_encode([
    'error' => 'Не указан курс'
  ]);
  exit;
}
