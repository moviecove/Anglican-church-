<?php
header("Content-Type: application/json");

$file = $_POST['file'] ?? '';
$data = $_POST['data'] ?? '';

if (!$file || !$data) {
  echo json_encode(["success" => false, "msg" => "Invalid request"]);
  exit;
}

$items = file_exists($file)
  ? json_decode(file_get_contents($file), true)
  : [];

if (!is_array($items)) $items = [];

$new = json_decode($data, true);
$new["id"] = uniqid("item_");
$new["timestamp"] = time();

$items[] = $new;

file_put_contents($file, json_encode($items, JSON_PRETTY_PRINT));

echo json_encode(["success" => true]);