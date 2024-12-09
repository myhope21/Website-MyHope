<?php
include("database.php");  // Koneksi ke database
include("send_email.php");  // Menyertakan fungsi pengiriman email

// Mengambil semua harapan yang harus dikirim hari ini
$sql = "SELECT * FROM wishes WHERE send_date = CURDATE()";  // Mengambil harapan dengan tanggal pengiriman hari ini
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $wish = $row['wish'];
    
    // Mengambil email pengguna dari database
    $user_sql = "SELECT email FROM users WHERE id = $user_id";
    $user_result = $conn->query($user_sql);
    $user = $user_result->fetch_assoc();

    if ($user) {
        // Mengirim email ke pengguna
        $subject = "Your Wish from MyHope";
        $body = "Hello! Here is your wish:\n\n" . $wish;
        sendEmail($user['email'], $subject, $body);
    }
}
?>
