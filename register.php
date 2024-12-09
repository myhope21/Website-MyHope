<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql)) {
        echo "<p>Registration successful. <a href='login.php'>Login here</a>.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<?php include("header.html"); ?>
<main>
    <form method="POST" class="form">
        <h2>Register</h2>
        <label>Name: <input type="text" name="name" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <button type="submit">Register</button>
    </form>
</main>
<?php include("footer.html"); ?>
