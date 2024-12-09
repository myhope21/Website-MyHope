<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wish = $_POST['wish'];
    $send_date = $_POST['send_date'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO wishes (user_id, wish, send_date) VALUES ('$user_id', '$wish', '$send_date')";
    if (!$conn->query($sql)) {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

$sql = "SELECT * FROM wishes WHERE user_id = {$_SESSION['user_id']}";
$result = $conn->query($sql);
?>

<?php include("header.html"); ?>
<main>
    <form method="POST" class="form">
        <h2>Write Your Wish</h2>
        <textarea name="wish" placeholder="Write your wish here..." required></textarea>
        <label>Send Date: <input type="date" name="send_date" required></label>
        <button type="submit">Save Wish</button>
    </form>

    <h2>Your Wishes</h2>
    <ul>
        <?php while ($wish = $result->fetch_assoc()): ?>
            <li><?= htmlspecialchars($wish['wish']) ?> (To be sent: <?= htmlspecialchars($wish['send_date']) ?>)</li>
        <?php endwhile; ?>
    </ul>
</main>
<?php include("footer.html"); ?>
