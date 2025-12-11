<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Реєстрація успішна. <a href='login.php'>Увійти</a>";
    } else {
        echo "Помилка реєстрації (можливо, таке ім'я вже існує): " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Реєстрація</title></head>
<body>
<h2>Реєстрація</h2>
<form method="POST" action="">
    <label>Ім'я користувача:</label><br>
    <input type="text" name="username" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Пароль:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Зареєструватися">
</form>
</body>
</html>