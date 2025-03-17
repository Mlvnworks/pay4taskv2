<?php


use Google\Client;
use Google\Service\Drive;

function uploadToGoogleDrive($file, $folderId = '1h30-cSVqCiHRTyz3GM2TurnWB4uR8U2-') {
    // Initialize Google Client
    $client = new Client();
    $client->setAuthConfig('./google-key.json'); // Path to Service Account JSON key
    $client->addScope(Drive::DRIVE_FILE);
    $driveService = new Drive($client);

    // Check for errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $fileName = $file['name'];
    $filePath = $file['tmp_name'];
    $fileType = mime_content_type($filePath);

    // Set Google Drive file metadata
    $fileMetadata = new Drive\DriveFile([
        'name' => $fileName,
        'parents' => [$folderId] // Set the target folder
    ]);

    // Upload the file to Google Drive
    $content = file_get_contents($filePath);
    if ($content === false) {
        return false;
    }

    $uploadedFile = $driveService->files->create($fileMetadata, [
        'data' => $content,
        'mimeType' => $fileType,
        'uploadType' => 'multipart',
        'fields' => 'id'
    ]);
    
    // Return file ID or error
    return $uploadedFile->id ?  $uploadedFile->id : false;
}
?>
