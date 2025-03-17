<?php
use Google\Client;
use Google\Service\Drive;

function deleteFileFromDrive($fileId) {
    // Set up the client
    $client = new Client();
    $client->setAuthConfig('./google-key.json'); // Replace with your credentials file
    $client->setScopes(Drive::DRIVE);

    // Initialize the Drive service
    $driveService = new Drive($client);

    try {
        // Delete the file using the file ID
        $driveService->files->delete($fileId);
        return true;
    } catch (Google_Service_Exception $e) {
        return false;
    }
}
