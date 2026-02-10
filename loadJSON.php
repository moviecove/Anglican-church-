<?php
// loadJSON.php

// Path to your announcements JSON file
$file = __DIR__ . '/announcements.json';

// Set the content type to JSON
header('Content-Type: application/json');

// Check if file exists
if (!file_exists($file)) {
    echo json_encode([]); // return empty array if file doesn't exist
    exit;
}

// Read file content
$json = file_get_contents($file);

// Decode to check validity
$data = json_decode($json, true);

// If invalid JSON, return empty array
if ($data === null) {
    echo json_encode([]);
    exit;
}

// Return the JSON
echo json_encode($data);
?>