<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Ganti dengan path yang sesuai jika tidak menggunakan Composer

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';  // Ganti dengan SMTP server Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com';  // Ganti dengan email pengirim
        $mail->Password = 'your_password';  // Ganti dengan password email pengirim
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan pengirim dan penerima
        $mail->setFrom('your_email@example.com', 'MyHope');
        $mail->addAddress($to); // Menambahkan penerima email

        // Isi email
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo 'Email berhasil dikirim ke ' . $to;
    } catch (Exception $e) {
        echo "Email tidak dapat dikirim. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
