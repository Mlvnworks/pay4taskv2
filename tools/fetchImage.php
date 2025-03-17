<?php
$fileId = $_GET['id'] ?? null;

if (!$fileId) {
    http_response_code(400);
    echo "Missing file ID";
    exit;
}

// Google Drive public URL
$driveUrl = "https://drive.google.com/uc?export=view&id=$fileId";

// Fetch the image content
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $driveUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

// Return the image
header("Content-Type: $contentType");
echo $response;