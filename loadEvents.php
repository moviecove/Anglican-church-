<?php
header("Content-Type: application/json");

$file = "events.json";

if (!file_exists($file)) {
  echo json_encode([]);
  exit;
}

$data = json_decode(file_get_contents($file), true);
echo is_array($data) ? json_encode($data) : json_encode([]);