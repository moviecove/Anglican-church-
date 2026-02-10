<?php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

$section = $input["section"] ?? "";
$id = $input["id"] ?? "";

if (!$section || !$id) {
  echo json_encode([]);
  exit;
}

$file = $section . ".json";

if (!file_exists($file)) {
  echo json_encode([]);
  exit;
}

$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

$data = array_values(array_filter($data, function ($item) use ($id) {
  return isset($item["id"]) && $item["id"] !== $id;
}));

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode($data);