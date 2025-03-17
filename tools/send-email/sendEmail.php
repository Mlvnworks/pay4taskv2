<?php
// Include PHPMailer classes (autoloader required if installed via Composer)
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($toEmail, $toName, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';             // Your SMTP server
        $mail->SMTPAuth   = true;                           // Enable SMTP authentication
        $mail->Username   = 'payfortask@gmail.com';       // SMTP username
        $mail->Password   = 'loai dasv qsuq kgzm';                // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                            // SMTP port (use 465 for SSL)

        // Email settings
        $mail->setFrom('payfortask@gmail.com', 'Pay4Task');
        $mail->addAddress($toEmail, $toName);               // Add recipient
        $mail->isHTML(true);                                // Set email format to HTML
        $mail->Subject = $subject;                         // Email subject
        $mail->Body    = $body;                            // HTML message body
        $mail->AltBody = strip_tags($body);                // Fallback for plain text emails

        // Send the email
        if ($mail->send()) {
            return true;
        }
    } catch (Exception $e) {
        print_r($e);
        return false;
    }
}
