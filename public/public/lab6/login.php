<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "Невірний пароль.";
        }
    } else {
        echo "Користувача не знайдено.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Вхід</title></head>
<body>
<h2>Авторизація</h2>
<form method="POST" action="">
    <label>Ім'я користувача:</label><br>
    <input type="text" name="username" required><br>
    <label>Пароль:</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Увійти">
</form>
<p>Немає акаунту? <a href="register.php">Зареєструватися</a></p>
</body>
</html>