<?php
define("DB_HOST", "MySQL-8.4");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "project");

// PDO
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false
];
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
