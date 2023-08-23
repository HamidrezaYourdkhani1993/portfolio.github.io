<?php
// SMTP Server Details
$smtp_server = 'smtp.gmail.com';
$smtp_port = 587;

// Gmail Account Credentials
$sender_email = 'hamidreza.yourdkhani1993@gmail.com';
$sender_password = 'jaqgbvlhffwwvxbr'; // Or your Gmail account password if you're not using an App Password

// Recipient Email
$recipient_email = 'recipient@example.com';

// Email Content
$subject = 'Subject of your email';
$message = 'Content of your email';

// Create a MIME message
$headers = "From: $sender_email\r\n" .
           "Reply-To: $sender_email\r\n" .
           "MIME-Version: 1.0\r\n" .
           "Content-type: text/html; charset=utf-8\r\n";

// Connect to the SMTP server
$smtp_conn = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 10);

if (!$smtp_conn) {
    echo "SMTP Connection Failed: $errstr ($errno)";
} else {
    // Read the welcome message
    $response = fgets($smtp_conn, 515);
    
    // Send EHLO command
    fputs($smtp_conn, "EHLO $smtp_server\r\n");
    $response = fgets($smtp_conn, 515);
    
    // Start TLS
    fputs($smtp_conn, "STARTTLS\r\n");
    $response = fgets($smtp_conn, 515);
    
    // Establish secure connection
    stream_socket_enable_crypto($smtp_conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    
    // Authenticate
    fputs($smtp_conn, "AUTH LOGIN\r\n");
    $response = fgets($smtp_conn, 515);
    
    fputs($smtp_conn, base64_encode($sender_email) . "\r\n");
    $response = fgets($smtp_conn, 515);
    
    fputs($smtp_conn, base64_encode($sender_password) . "\r\n");
    $response = fgets($smtp_conn, 515);
    
    // Set sender and recipient
    fputs($smtp_conn, "MAIL FROM: <$sender_email>\r\n");
    $response = fgets($smtp_conn, 515);
    
    fputs($smtp_conn, "RCPT TO: <$recipient_email>\r\n");
    $response = fgets($smtp_conn, 515);
    
    // Send email data
    fputs($smtp_conn, "DATA\r\n");
    $response = fgets($smtp_conn, 515);
    
    fputs($smtp_conn, "Subject: $subject\r\n$headers\r\n$message\r\n.\r\n");
    $response = fgets($smtp_conn, 515);
    
    // Quit
    fputs($smtp_conn, "QUIT\r\n");
    
    fclose($smtp_conn);
}
?>